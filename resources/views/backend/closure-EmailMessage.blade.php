    {{-- <?php
    // echo"<pre>";
    // print_r($userMessg);
    // die;
    ?> --}}
    <style>
        .header-sender {
            background-color: #495A6D;
            color: white;
        }
    </style>
    @extends('backend.layouts.backapp')
    @section('title', 'Flash Alert')
    @section('content')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Send Message to User
                    <small></small>
                </h1>
                <ol class="breadcrumb fw-6 font-14">
                    <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li class="active">Send Message to User</li>
                </ol>
            </section>
            <form method="POST" action={{ route('closure.sendclosuresmess') }}>
                @csrf
                <section class="content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class=" ">
                                <div class="col-md-12">
                                    <div class="box box-warning">
                                        <div class="box-body">
                                            <div class="col-md-12">
                                                <h4 class="header-sender" style="padding:5px;">Sender</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><b>From:</b> (Email Address)</label>
                                                    <input type="text" class="form-control" name="senderemail"
                                                        value="info@projects-codingbrains.com" readonly/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h4 class="header-sender" style="padding:5px;">Recipient</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <h3 class="" style="padding:5px;">{{ $userMessg[0]->PrimaryName }}
                                                </h3>
                                                <input type="hidden" name="primaryname"
                                                    value="{{ $userMessg[0]->PrimaryName }}">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Primary Work:</label>
                                                    <input type="text" class="form-control" name="primaryworkemail"
                                                        value="{{ $userMessg[0]->PrimaryWorkEmail }}" />
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Primary Home:</label>
                                                    <input type="hidden" class="form-control" name="primaryhomeemail"
                                                        value="{{ $userMessg[0]->PrimaryHomeEmail }}" />
                                                </div>
                                            </div> --}}

                                            <div class="col-md-12">
                                                <h3 class="" style="padding:5px;">{{ $userMessg[0]->SecondaryName }}
                                                </h3>
                                                <input type="hidden" name="secondaryName"
                                                    value="{{ $userMessg[0]->SecondaryName }}">
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Secondary Work:</label>
                                                    <input type="text" class="form-control" name="secondaryworkemail"
                                                        value="{{ $userMessg[0]->SecondaryWorkEmail }}" />
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Secondary Home:</label>
                                                    <input type="text" class="form-control" name="secondaryhomeemail"
                                                        value="{{ $userMessg[0]->SecondaryHomeEmail }}" />
                                                </div>
                                            </div> --}}
                                            <div class="col-md-12">
                                                <h4 class="header-sender" style="padding:5px;">Regarding</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Subject:</label>
                                                    <input type="text" class="form-control" name="csubject"
                                                        value="RE: {{ $reportmass[0]->name }} -{{ $reportmass[0]->Note }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h4 class="header-sender" style="padding:5px;">Message Content</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Message:</label>
                                                    <textarea id="" name="message" wrap="virtual" rows="10" cols="73" style="height: 45px;"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="float:right;">
                                                    <i class="fa-solid fa-circle-up"></i>
                                                    <i class="fa-solid fa-circle-down"></i>
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="col-md-12"
                                                    style="text-align: right; background-color: #CCCCCC;">
                                                    <input type="reset" name="" value="Reset">
                                                    <input type="submit" name="" value="Send Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>

    @endsection
