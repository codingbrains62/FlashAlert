@extends('backend.layouts.backapp')
@section('title', 'News Media')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            List of News Media Recipients
            <small></small>
        </h1>
        <ol class="breadcrumb fw-6 font-14">
            <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">News Media Recipients</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="post" action="{{ route('news.media.recipients') }}">
                    @csrf
                    <div class="info-box box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Region</label>
                                    <select class="form-control" id="getquicksignup" name="Region" onchange="this.form.submit();">
                                        <option value="">Select Region</option>
                                        @foreach ($data as $datas)
                                        <option value="{{ $datas->id }}" @if ($datas->id == $selectedRegion) selected @endif>{{ $datas->Description }}</option>
                                        @endforeach
                                        @error('Region')
                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            @if (!empty($selectedRegion))
            @if (!empty($response) && $response->count() > 0)
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding tbl-border">
                        <table class="table fw-6">
                            <tbody>
                                @php
                                $current_state = null;
                                $current_city = null;
                                $current_email = null;
                                foreach ($response as $datas) {
                                $state_name = $datas->CityName;
                                $city_name = $datas->Name;
                                $email = $datas->EmergencyEmail;
                                if ($state_name != $current_state) {
                                $current_state = $state_name;
                                @endphp

                                <tr class="table-name reason-bg" style="background-color:#263102; color:#fff;">
                                    <td colspan="10"><strong>{!! @$state_name !!}</strong></td>
                                </tr>
                                @php
                                }
                                if ($city_name != $current_city) {
                                $current_city = $city_name;
                                @endphp

                                <tr class="table-name">
                                    <td colspan="10" style="color:blue;"><strong>{{ @$city_name }}</strong></td>
                                </tr>
                                @php
                                }
                                if ($email != $current_email) {
                                $current_email = $email;
                                @endphp

                                <tr class="table-name">
                                    @if ($email == 1)
                                    <td colspan="10"><strong>Emergency:</strong></td>
                                    @else
                                    <td colspan="10"><strong>News Releases:</strong></td>
                                    @endif
                                </tr>
                                @php
                                }
                                @endphp
                                <tr class="table-name">
                                    @if ($email == 1)
                                    <td colspan="10" value="">{{ $datas->Address }}</td>
                                    @else
                                    <td colspan="10" value="">{{ $datas->Address }}</td>
                                    @endif
                                </tr>
                                @php
                                }
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="col-xs-12">
                <div class="alert alert-info">
                    No data found for the selected region.
                </div>
            </div>
            @endif
            @endif
        </div>
    </section>
</div>
@endsection