@extends('backend.layouts.backapp')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {{-- New Sub-Org page  --}}
                    <div class="box border-0">
                        <div class="box-header with-border cus-head">
                            <h3 class="box-title ">Parent Organization</h3>
                        </div>

                        <form role="form">
                            <div class="box-body">
                                <h3>Suraj Shukla</h3>
                                <div>
                                    <span><b class="font-16">Region :</b> Bend/Central-Eastern Oregon</span>
                                </div>
                                <div>
                                    <span><b class="font-16">Category :</b> Businesses</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- ---------------------------- --}}
                    <div class="box border-0">
                        <div class="box-header with-border cus-head">
                            <h3 class="box-title ">New Sub-Org</h3>
                        </div>

                        <form role="form">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> Organization Name <span class="text-danger">*</span></label><br>
                                        <small>This is the official name that will appear in the reports. It should be as
                                            short as possible
                                            and may be edited for consistency in style with similar organizations.</small>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mr-2"> Username</label><br>
                                        <small> This is the shorthand name you will use to identify yourself to the system.
                                            It can be an abbreviation.</small>
                                        <input type="text" class="form-control">


                                    </div>
                                    <div class="col-md-6">
                                        <label> Password</label><br>
                                        <small> Choose a password of 4-64 letters and/or numbers. It is not case
                                            sensitive.</small>
                                        <input type="password" class="form-control">
                                        <div class="checkbox my-2">
                                            <label> <input type="checkbox">Show Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-5 float-r">
                                        <button type="button" class="btn btn-block btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                {{-- New Sub-Org page  --}}
            </div>
    </div>
    </section>
    </div>
@endsection
