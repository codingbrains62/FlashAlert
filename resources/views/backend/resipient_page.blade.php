@php

@endphp
@extends('backend.layouts.backapp')
@section('title', 'Station/Recipients')
@section('content')
<style>
    .pagination-info {
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #333;
        margin: 10px;
    }

    .current-page {
        font-weight: bold;
        color: #ff0000;
        /* red */
    }

    .first-item,
    .last-item,
    .total {
        font-weight: bold;
        color: #0000ff;
        /* blue */
    }

    .custom-btn {
        padding: 10px 15px;
        font-size: 16px;
        width: 100px;
        text-align: center;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            @if (isset($dataRegion[0]))
            Edit Station/Recipients
            @else
            Add Station/Recipients
            @endif
            <small></small>
        </h1>
        <ol class="breadcrumb font-14 fw-6">
            <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li class="active">Station/Recipients</li>
        </ol>
    </section>
    @if (Session::has('success'))
    <script>
        swal({
            title: "Done!",
            text: "{{ Session::get('success') }}",
            icon: "success",
            timer: 3000
        });
    </script>
    <!-- <div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    {{ Session::get('success') }}
                                </div> -->
    @elseif (Session::has('failed'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ Session::get('failed') }}
    </div>
    @endif
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <div class="row">
                            @php
                            $previousUrl = url()->previous();
                            @endphp
                            {{-- <div class="col-md-12 mb-2"><a href="{{ $previousUrl }}" class="btn btn-info">BACK</a>
                        </div> --}}

                        <!-- <div class="col-md-12 mb-2"><a href="{{ route('station.recipiant') }}" class="btn btn-info">BACK</a></div> -->
                        <div class="col-md-6">
                            <form method="post" action="{{ route('add.station') }}">
                                @csrf
                                <input type="hidden" name="hidden" value="{{ @$dataRegion[0]->id }}">
                                <div class="form-group">
                                    <label>Select Region</label>
                                    <select class="form-control" id="regionDropdown" name="region">
                                        <option value="">All</option>
                                        @foreach ($data as $datas)
                                        <option value="{{ $datas->id }}" @if (isset($dataRegion[0])) {{ $datas->id == $dataRegion[0]->RegionID ? 'selected' : '' }} @endif>
                                            {{ $datas->Description }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('region')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                @if (isset($dataRegion[0]))

                                <select class="form-control" name="city" id="city">
                                    @foreach ($city as $cities)
                                    <option value="{{ $cities->cid }}" @if (isset($dataRegion[0])) {{ $cities->cid == $dataRegion[0]->CityID ? 'selected' : '' }} @endif>
                                        {!! $cities->CityName !!}</option>
                                    @endforeach
                                </select>
                                @else
                                <select class="form-control" name="city" id="city">
                                    <option value="">Select</option>

                                </select>
                                @endif
                                @error('city')
                                <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Year Verified</label>
                                <input type="text" name="YearVerified" class="form-control" value="{{ @$dataRegion[0]->DateVerified }}">

                            </div>
                        </div>
                        <!-- <input type="hidden" name="CityCode" class="form-control" value="{{ @$dataRegion[0]->CityCode }}"> -->
                        @if (@$dataRegion[0] == '')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City Code</label>
                                <input type="text" name="CityCode" class="form-control" value="{{ @$dataRegion[0]->CityCode }}">
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Station/Recipient Name</label>
                                <input type="text" name="StationRecipientName" class="form-control" value="{{ @$dataRegion[0]->Name }}">
                                @error('StationRecipientName')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact Information</label>

                                <textarea name="ContactInformation" class="form-control" rows="4">{{ @$dataRegion[0]->ContactInfo }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox mt-0">
                                <label> <input type="checkbox" name="Testing" value="1" @php if(isset($dataRegion[0])){ echo (($dataRegion[0]->Testing )==1 ? 'checked' : '');} @endphp> Testing</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                @if (isset($dataRegion[0]))
                                <input type="submit" value="SAVE" class="btn btn-success col-xs-12 col-sm-3 col-md-2">
                                <button type="reset" class="btn btn-primary col-xs-12 col-sm-3 col-md-2 mx-2 margin-sm-y">Cancel</button>
                                <a href="{{ url('IIN/delete-station/' . base64_encode(@$dataRegion[0]->id)) }}" class="btn btn-danger col-xs-12 col-sm-3 col-md-2 mx-2 margin-sm-y" onclick="showConfirmDialog(event)">Delete</a>

                                <!-- <button class="btn btn-default">Send Update Request</button> -->
                                <a type="button" href="{{ url('IIN/req-update/' . base64_encode(@$dataRegion[0]->id)) }}" class="btn btn-default col-xs-12 col-sm-3 col-md-2 "><i class="fa fa-fw fa-send"></i> Send Update Request</a>
                                @else
                                <input type="submit" value="ADD" class="btn btn-success col-xs-12 col-sm-3 col-md-2 mx-2 mx-sm-0 mb-sm8">
                                <!-- <button class="btn btn-default">Send Update Request</button> -->
                                <a href="" class="btn btn-default col-xs-12 col-sm-5 col-md-2 mx-2 mx-sm-0"><i class="fa fa-fw fa-send mr-1"></i> Send Update Request</a>
                                @endif

                            </div>
                        </div>

                    </div>
                    </form>
                </div>

            </div>
        </div>
</div>

<!--emailrow -->
@if (isset($mail))
Edit Recipients > Email
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <div class="row">
                    <form method="post" action="{{ route('add.station.email') }}">
                        <div class="row mx-0">
                            <div class="col-sm-5 col-md-5">
                                @csrf
                                <input type="hidden" name="hidden" value="{{ @$subemail[0]->id }}">
                                <input type="hidden" name="subid" value="{{ @$dataRegion[0]->id }}">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="0" @if (@$subemail[0]->EmergencyEmail == 0) selected @endif>News Releases,
                                            Conf. and Mtg Agendas</option>
                                        <option value="4" @if (@$subemail[0]->EmergencyEmail == 4) selected @endif>Reminder</option>
                                        <option value="2" @if (@$subemail[0]->EmergencyEmail == 2) selected @endif>Sports</option>
                                        <option value="1" @if (@$subemail[0]->EmergencyEmail == 1) selected @endif>Emergency
                                        </option>

                                    </select>
                                    @error('type')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="form-group">
                                    <label>Email Addresses</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ isset($subemail) && count($subemail) > 0 ? $subemail[0]->Address : '' }}">
                                    @error('email')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label></label>
                                    @if (isset($subemail[0]))
                                    <input type="submit" name="submit" value="Update" class="btn btn-info mt-25">
                                    @else
                                    <input type="submit" name="submit" value="Add" class="btn btn-success mt-25">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>



                    @foreach ($mail as $mails)
                    <div class="row mx-0">
                        <div class="col-md-5 col-sm-4 col-xs-6 fw-bold">
                            <div class="form-group">
                                @if ($mails->EmergencyEmail == 0)
                                News Releases
                                @elseif($mails->EmergencyEmail == 1)
                                Emergency
                                @elseif($mails->EmergencyEmail == 2)
                                Sports
                                @else
                                Reminder
                                @endif

                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-6 fw-bold">
                            {{ $mails->Address }}
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <a href="{{ url('IIN/edit-station-email/' . base64_encode(@$mails->id)) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ url('IIN/delete-station-email/' . base64_encode(@$mails->id)) }}" class="btn btn-danger btn-sm" onclick="showConfirmDialog(event)">Delete</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>

        </div>
    </div>
</div>
@endif
<!--emailrowend -->
<!----ftprow-->
@if (isset($subftp))
Edit Recipients > FTP Sites
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <div class="col-md-12 mb-2"><a href="{{ url('IIN/station-ftp/' . base64_encode(@$dataRegion[0]->id)) }}" class="btn btn-info">Add New FTP</a>
                </div>

                <table style="width:100%;" class="table">
                    <thead>
                        <th>Address</th>
                        <th>Style</th>
                        <th>Remote Path</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($subftp as $subftps)
                        <tr>
                            <td>{{ $subftps->Address }}</td>
                            <td>{{ $subftps->Name }}</td>
                            <td>{{ $subftps->FilePath }}</td>
                            <td><a href="{{ url('IIN/edit-ftp/' . base64_encode(@$subftps->id)) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
<!---ftprowend--->
</section>
</div>

<script>
    $(document).ready(function() {
        $("#regionDropdown").on('change', function() {
            var id = $("#regionDropdown").val();
            var url = "{{ route('get.city') }}"
            $.ajax({
                url: url,
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $("#city").html(result);
                }
            })
        });

    });
</script>

@if (session('success'))
<script>
    document.getElementById('email').value = '';
</script>
@endif


@endsection