@extends('backend.layouts.backapp')
@section('title', 'Add User')
@section('content')
<style>
    .adity{
    margin-left:auto;
    height: auto;
    min-height: 100%;
    }
</style>
<div class="content-wrapper @unless(Session::has('loginId'))adity @endunless">
    <section class="content-header">
        <h1>
            FlashAlert Signup
            <small></small>
        </h1>
        <ol class="breadcrumb fw-6 font-14">
            <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">FlashAlert Signup </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <form method="post" action="{{ route('add.newuserdata') }}">
                @csrf
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
                </div>
                @endif
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" name="RegionID" value="{{ @$adduserregion }}">
                    <div class="info-box box-body">
                        <h4 class="bg-info p-3">Please provide your organizational information</h4>
                        <div><b>All information will remain confidential.</b></div>
                        <div><b><span class="text-danger"> * </span> Required Field</b></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label><b> Category:<span class="text-danger"> * </span></b> </label>
                                    <div>Choose an appropriate category for your organization.</div>

                                    <select class="form-control" id="OrgCatID" name="OrgCatID">
                                        <option value="">Select</option>
                                        @foreach ($data1 as $datas)
                                        <option value="{{ $datas->id }}" @if (session::get('OrgCatID') == $datas->id) selected @endif>
                                            {{ old('CatagoryName', $datas->CatagoryName) }}
                                           </option>
                                        @endforeach
                                    </select>
                                    @error('OrgCatID')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label><b> Organization Name:<span class="text-danger"> * </span></b> </label>
                                    <small>This is the official name that will appear in the reports. It should be as short as
                                        possible may be edited for consistency in style with similar organizations.</small>
                                    <input type="text" class="form-control" name="Name" id="Name" size="60" value="{{session::get('Name')?: old('Name')}} ">
                                    @error('Name')
                                    <span style="color:red;" role="alert"><strong>{{ $trimmedString = str_replace("name", "Organization Name",$message )}}</strong></span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b> Username:<span class="text-danger"> * </span></b> </label>
                                    <small>This is the shorthand name you will use to identify yourself to the system. It can be
                                        an abbreviation of your organization's name and is not case sensitive.</small>
                                    <input type="text" class="form-control" name="UserName" id="UserName" size="60" value="{{session::get('UserName')?: old('UserName')}}">

                                    @error('UserName')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b> Password:<span class="text-danger"> * </span></b> Choose a password of 4-10 letters
                                        and/or numbers. It is not case sensitive.</label>
                                    <input type="password" class="form-control" name="PasswordHash" id="PasswordHash" size="60">
                                    @error('password')
                                    <span style="color:red;" role="alert"><strong>{{ $trimmedString = str_replace("hash", "",$message )}}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b> Password Verify <span class="text-danger"> * </span></b> Please re-enter your password
                                        for verification. </label>
                                    <input type="password" class="form-control" name="PasswordHash_confirmation" id="PasswordHash_confirmation" size="60">
                                    @error('PasswordHash_confirmation')
                                    <span style="color:red;" role="alert"><strong>{{ $trimmedString = str_replace("hash", "",$message )}}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Organization Address</b> </label>
                                    <input type="text" class="form-control" name="Address" id="Address" size="60" value="{{session::get('Address')?: old('Address')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>City</b> </label>
                                    <input type="text" class="form-control" name="City" id="City" size="60" value="{{session::get('City')?: old('City')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>State</b> </label>
                                    <input type="text" class="form-control" name="State" id="State" size="60" value="{{session::get('State')?: old('State')}}">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><b>Zipcode</b> </label>
                                    <input type="text" class="form-control" name="Zipcode" id="Zipcode" size="60" value="{{session::get('Zipcode')?: old('Zipcode')}}">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Your organization's home page URL</b> </label>
                                    <input type="text" class="form-control" name="URLName" id="URLName" size="60" value="{{session::get('UrlName')?: old('UrlName')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Name of Primary Contact: <span class="text-danger"> * </span></b>Name of contact person.
                                    </label>
                                    <input type="text" class="form-control" name="PrimaryName" id="PrimaryName" size="60" value="{{session::get('PrimaryName')?: old('PrimaryName')}}">
                                    @error('PrimaryName')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label><b>Primary Office Phone Number:<span class="text-danger"> * </span></b> </label>
                                    <input type="text" class="form-control" name="PrimaryPhone" id="PrimaryPhone" size="60" value="{{session::get('PrimaryPhone')?: old('PrimaryPhone')}}">
                                    @error('PrimaryPhone')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label><b>Office Email Address:<span class="text-danger"> * </span></b> (Receives a copy of all
                                        messages posted.)</label>
                                    <input type="text" class="form-control" name="PrimaryWorkEmail" id="PrimaryWorkEmail" size="60" value="{{session::get('PrimaryWorkEmail')?: old('PrimaryWorkEmail')}}">
                                    @error('PrimaryWorkEmail')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        {{-- <div><b> Home Phone Number:<span class="text-danger"> </span></b>(System administrator
                                emergency use only.) </div> --}}
                        {{-- <div> --}}
                        <input type="hidden" name="HomePhone" id="HomePhone" size="60" value="{{session::get('HomePhone')?: old('HomePhone')}}">
                        {{-- </div> --}}
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b> Name of Secondary Contact:<span class="text-danger"> </span></b>(Optional)</label>
                                    <input type="text" class="form-control" name="SecondaryName" id="SecondaryName" size="60" value="{{session::get('SecondaryName')?: old('SecondaryName')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b> Office Email Address for Secondary Contact:<span class="text-danger"> </span></b>(Optional)</label>
                                    <input type="text" class="form-control" name="SecondaryPhone" id="SecondaryPhone" size="60" value="{{session::get('SecondaryPhone')?: old('SecondaryPhone')}}">
                                </div>
                            </div>
                            <div class="col-md-2 mt-3">
                                <input type="submit" name="addnewuser" value="Next" class="btn btn-block btn-success">
                            </div>
                            <div class="col-md-2 mt-3">
                                <a href="{{url('https://flashalert.projects-codingbrains.com/IIN/addnewuser')}}" class="btn btn-block btn-default">Back</a>
                            </div>
                        </div>


                    </div>

                </div>
            </form>
        </div>
    </section>
</div>
@endsection