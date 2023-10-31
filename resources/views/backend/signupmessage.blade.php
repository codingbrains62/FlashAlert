@extends('backend.layouts.backapp')
@section('title', 'Quick Signup')
@section('content')
<style>
   .line:hover{
    text-decoration:underline;
   }
   .adity {
        margin-left: auto;
        height: auto;
        min-height: 100%;
    }
</style>
<div class="content-wrapper @unless(Session::has('loginId'))adity @endunless">
    <section class="content-header">
        <h1>
            FlashAlert Policy :
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">FlashAlert Policy :</li>
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
            <form method="post" action="{{ route('show.userdata') }}">
                @csrf
                <div class="col-md-12 col-sm-12 col-xs-12">
                FlashAlert Newswire Signup
                    <div class="info-box" style="padding:18px;">
                        <h4 class="bg-info" style="padding:5px;">SignUp Completed!:</h4>
                       <p style="text-align:center;"><b>Your Sign Up was Succesfull</b></p> 
                     
                       <p style="text-align:center;">  Your account will be active as soon as it is authenticated by FlashAlert.</p>
                       <p style="text-align:center;">You will receive an email when your account has been confirmed and activated, which may take up to 24 hours.</p>
                       <p style="text-align:center;"><u><b><a href="{{route('logout')}}">Login with your account.</a></u></b></p> 

                    </div>

                </div>

            </form>
        </div>
    </section>
</div>

@endsection