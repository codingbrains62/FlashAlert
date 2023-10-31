@extends('backend.layouts.backapp')
@section('title', 'Add new user policy')
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
                        <h4 class="bg-info" style="padding:5px;">Payment Information & User Agreement:</h4>
                       <p><b>Annual Fee: 	 -</b></p> 
                       <P><b>Payment:</b>  If payment is due, you may:</P> 	
                       <p>1.  <a href="https://zohosecurepay.com/checkout/8wkrz69-zhaj5jyg9zd0k/FlashAlert-Newswire" class="line">Click here to pay by credit card, then return to this page.</a></p>  
                       <p>2.  Send a check to FlashAlert Newswire, 61572 Searcy Ct., Bend OR 87702. Fed Tax ID 91-2021669</p> 
                       <p>3.  <a href="http://www.flashalertnewswire.net/w9.pdf" class="line">Click here to obtain a copy of CWC's Federal Tax Form W-9 </a></p>
                       <p><b> User Agreement:</b></p>
                       <p>Please read and agree to the <b><u><a href="">Terms of Use and Privacy Policy.</a></u></b></p> 
                       <input type="submit" name="addnewuser" value="I Agree" style="margin-top:10px;" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection