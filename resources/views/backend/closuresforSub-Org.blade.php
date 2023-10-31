<style>
    .button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Report Submission
                <small></small>
            </h1>
            <ol class="breadcrumb font-14 fw-6">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Report Submission</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class=" ">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <form method="post" action="{{ route('fa.closurereportssubmission') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Select asterick</label>
                                                    <select class="form-control" name="firstselectbox"
                                                        onchange="this.form.submit()">
                                                        <option selected="" value="">All</option>
                                                        <option value="1"
                                                            @if ('1' == $firstselectbox) selected @endif>1</option>
                                                        <option value="2"
                                                            @if ('2' == $firstselectbox) selected @endif>2</option>
                                                        <option value="active"
                                                            @if ('active' == $firstselectbox) selected @endif>Active
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Region</label>
                                                    <select class="form-control" id="regionDropdown" name="region"
                                                        onchange="this.form.submit(),updateOrgCatSelect()">
                                                        <option value="">All</option>
                                                        @foreach ($data as $datas)
                                                            <option value="{{ $datas->id }}"
                                                                @if ($datas->id == $selectedRegion) selected @endif>
                                                                {{ $datas->Description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($category != '')
                                                <div class="col-md-12">
                                                    <div id="orgCatDropdown">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Select Organization Category</label>
                                                                <select class="form-control" id="orgCatSelect"
                                                                    name="orgCatSelect" onchange="this.form.submit()">
                                                                    <option value="">All</option>
                                                                    @foreach ($category as $categories)
                                                                    <option value="{{ $categories->id }}"@if ($categories->id == $selectedorgcat) selected @endif>
                                                                        {{ $categories->CatagoryName }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive no-padding tbl-border">
                                    <table class="table table-hover">
                                        <thead class="thead-bg">
                                            <tr>
                                                <th>Org</th>
                                                <th>Note</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $current_state = null;
                                            $current_city = null;
                                            foreach ($response as $datas) {
                                            $state_name = $datas->Description;
                                            $city_name = $datas->CatagoryName;
                                            if ($state_name != $current_state) {
                                            $current_state = $state_name;
                                            @endphp
                                            <tr class="table-name reason-bg" style="background-color:#263102; color:#fff;">
                                                <td colspan="10" value="">{{@$state_name}}</td>
                                            </tr>
                                            @php
                                            }
                                            if ($city_name != $current_city) {
                                            $current_city = $city_name;
                                            @endphp                      
                                            <tr class="table-name">
                                                <td colspan="10" value="">{{@$city_name}}</td>
                                            </tr>
                                            <tr>
                                                @php
                                                }
                                                @endphp
                                                <td value="">{{@$datas->Name}}</td>
                                                <td value="">Test Note</td>
                                                <td value="">Test date</td>
                                                <td class="text-nowrap">
                                                    <form action="">
                                                        <a href="{{ url('IIN/closureemergmess-' . base64_encode($datas->OrgID)) }}" class="button">Add Tset</a>
                                                        <a href="{{ url('IIN/closuresendmessage-' . base64_encode($datas->OrgID)) }}" class="button">Email</a>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php
                                            }
                                            @endphp
                                        </tbody>
                                    </table>
                                    {{ $response->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script>
        function updateOrgCatSelect() {
            document.getElementById("orgCatSelect").selectedIndex = 0; // Reset orgCatSelect to the first option
            document.getElementById("orgCatSelect").onchange();
        }
    </script>


@endsection
