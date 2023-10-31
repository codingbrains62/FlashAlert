@extends('frontend.layouts.app')
@section('content')
<section>
    <div style="background: #c5e3ed">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="intro-box ">
                <div class="intro-text d-flex justify-content-center align-items-center">
                    <h1>PASSWORD RECOVERY</h1>
                </div>
            </div>
        </div>
        
    </div>
    <div class="container bank-union my-4" style="min-height: 42vh;">
        <form class="log-input front-login" method="post" action="your_action_url_here">
            <label for="EmailAddress" class="mb-3"><b>Please enter your Email Address</b></label>
            <input placeholder="E-mail" type="text" id="EmailAddress" name="EmailAddress" class="srch-form mb-4" required>
            <button type="submit" name="Submit" class="srch-btn">Reset password</button>
            <b class="text-center my-2"><a href="">Click here</a> to go back</b>
        </form>
    </div>
</section>
@endsection