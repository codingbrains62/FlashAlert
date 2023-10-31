@extends('backend.layouts.backapp')
@section('title', 'Quick Signup')
@section('content')
    <style>
        .line:hover {
            text-decoration: underline;
        }

        .adity {
            margin-left: auto;
            height: auto;
            min-height: 100%;
        }
    </style>
    <div class="content-wrapper @unless (Session::has('loginId'))adity @endunless"">
        <section class="content-header">
            <h1>
                Verify your Information: :
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Verify your Information::</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                @if (Session::has('success'))
                    <script>
                        swal({
                            title: "Done!",
                            text: "{{ Session::get('success') }}",
                            icon: "success",
                            timer: 3000
                        });
                    </script>
                @elseif (Session::has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('failed') }}
                    </div>
                @endif
                <form method="post" action="{{ route('insert.userdata') }}">
                    @csrf
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        FlashAlert Newswire Signup
                        <div class="info-box" style="padding:18px;">
                            <h4 class="bg-info" style="padding:5px;">Verify your Information::</h4>
                            <div class="row">
                                <div class="col-md-10">
                                    @php
                                        $region = Helper::getData('regions', Session::get('RegionID'));
                                        $org = Helper::getData('orgcats', Session::get('OrgCatID'));
                                    @endphp
                                    <p><b> Region: ~ {{ str_replace('/', '-', $region[0]->Description) }}</b></p>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('add.newuser') }}" class="btn btn-default">EDIT</a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <p><b>Category:</b></p>
                                    <p><b>Organization Name:</b></p>
                                    <p><b>User Name:</b></p>

                                    <p><b>Organization Address:</b></p>
                                    <p><b>City:</b></p>
                                    <p><b>State:</b></p>
                                    <p><b>Zipcode:</b></p>

                                    <p><b>Website URL:</b></p>
                                    <p><b>Name Of Primary Contact:</b></p>
                                    <p><b>Primary Office Phone No:</b></p>
                                    <p><b>Office Email Address:</b></p>

                                </div>
                                <div class="col-md-5">
                                    <p><b>{{ str_replace('/', '-', $org[0]->CatagoryName) }}</b></p>
                                    <P><b>{{ ucfirst(Session::get('Name')) }}</b></P>
                                    <P><b>{{ Session::get('UserName') }}</b></P>

                                    <p><b>{{ ucfirst(Session::get('Address')) ?: '----' }}</b></p>
                                    <P><b>{{ ucfirst(Session::get('City')) ?: '----' }}</b></P>
                                    <P><b>{{ ucfirst(Session::get('State')) ?: '-----' }}</b></P>
                                    <P><b>{{ ucfirst(Session::get('Zipcode')) ?: '-----' }}</b></P>

                                    <P><b>{{ ucfirst(Session::get('Zipcode')) ?: '-------' }}</b></P>
                                    <P><b>{{ ucfirst(Session::get('PrimaryName')) }}</b></P>
                                    <P><b>{{ ucfirst(Session::get('PrimaryPhone')) }}</b></P>
                                    <P><b>{{ ucfirst(Session::get('PrimaryWorkEmail')) }}</b></P>


                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('post.newuser') }}" class="btn btn-default">EDIT</a>
                                </div>
                            </div>
                            <hr>
                            <input type="submit" name="addnewuser" value="Next" style="margin-top:10px;"
                                class="btn btn-success">

                        </div>

                    </div>

                </form>
            </div>
        </section>
    </div>

@endsection
