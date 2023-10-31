@extends('backend.layouts.backapp')
@section('title', 'Sub Category')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Quick Signup Sub Org
            <small></small>
        </h1>
        <ol class="breadcrumb font-14 fw-6">
            <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quick Signup Sub Org</li>
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
    @elseif (Session::has('failed'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ Session::get('failed') }}
    </div>
    @endif
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="info-box">
                    <h4 class="box-header with-border cus-head">
                        <div class="row">
                            <div class="col-md-11"> Parent Organization</div>
                            <div class="col-md-1"> <a href="{{url('IIN/orginform/' . base64_encode($response[0]->id))}}" class="btn btn-info btn-xs ">Back</a></div>
                        </div>
                    </h4>
                    <form method="post" action="{{route('addsub.org')}}">
                        @csrf
                        <div class="row box-body ">
                            <input type="hidden" name="OrgID" value="{{$response[0]->id}}">
                            <input type="hidden" name="RegionID" value="{{$response1[0]->id}}">
                            <input type="hidden" name="CategoryID" value="{{$response2[0]->id}}">
                            <div class="col-md-12">
                                <h3 class="my-2"><b><?php echo $response[0]->Name; ?></b></h3>
                            </div>
                            <div class="col-md-12"><b>Region: </b><?php echo $response1[0]->Description; ?></div>
                            <div class="col-md-12"><b>Category: </b><?php echo $response2[0]->CatagoryName; ?></div>
                        </div>
                        <div class="row mx-0">
                            <h4 class="box-header with-border cus-head">New Sub Organization </h4>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="">Organization Name <span class="text-danger">*</span>
                                    </label><br>
                                    <small> This is the official name that will appear in the reports. It should be
                                        as short as possible
                                        and may be edited for consistency in style with similar
                                        organizations.</small>
                                    <input type="text" class="form-control" name="orgname" value="StingRay Communications">

                                </div>

                                @error('orgname')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                                <div class="form-group">
                                    <label>Username <span class="text-danger">*</span> </label>
                                    <small>This is the shorthand name you will use to identify yourself to the
                                        system. It can be an abbreviation.</small>
                                    <input type="text" name="uname" size="60" class="form-control">
                                </div>

                                @error('uname')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <small>Choose a password of 4-64 letters and/or numbers. It is not case
                                        sensitive.</small>
                                    <input type="password" name="password" size="30" class="form-control">
                                </div>

                                @error('password')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                                @if($response3[0]->FlashAlertSubscriber!=0)
                            </div>
                        </div>
                        <div class="row mx-0">
                            <h4 class="box-header with-border cus-head">Messenger Settings</h4>
                            <div class="col-md-6">
                                    <strong>Activate FlashAlert Messenger</strong>
                                    <p class="font-13">Allow the public to self register to receive your <strong>emergency
                                        messages</strong> as emails or phone app push notifications?</p>
                                    <div class="radio my-0" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios" value="1" checked="">

                                            Yes
                                        </label>
                                    </div>
                                    <div class="radio mx-3" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="0">
                                            No
                                        </label>
                                    </div>
                                    <input type="submit" value="ADD" class="btn btn-block btn-primary my-3">

                                </div>
                                <div class="col-md-6">
                                    <strong class="font">In addition to emergencies, enable your Messenger subscribers to
                                        receive your news releases ?</strong> 
                                    <div class="radio my-0" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios1" id="optionsRadios1" value="1" checked="">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="radio mx-3" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios1" id="optionsRadios2" value="0">
                                            No
                                        </label>
                                    </div>
                                </div>
                                @endif
                                
                        </div>
                    </form>
                </div>
    </section>
</div>

@endsection