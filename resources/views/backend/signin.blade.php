<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('front_assets/images/FlashAlert-Icon.png') }}" rel="icon">
    <link href="{{ url('front_assets/images/FlashAlert-apple-touch.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;400&family=Poppins:ital,wght@0,100;0,400;0,500;0,700;1,400&family=Raleway:wght@200;300;500&family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">
    <title>FlashAlert Newswire</title>
</head>
<style>
    body {
        background: linear-gradient(to bottom, #d1c0c8 0%, #b5a5a6 99%) fixed;
    }

    section {
        background: #FFF;
        margin: 30px;
    }

    p {
        font-family: 'Poppins', sans-serif;
        text-align: justify;
        font-size: 14px;
    }

    /* font-family: 'Inconsolata', monospace;
    font-family: 'Poppins', sans-serif;
    font-family: 'Raleway', sans-serif;
    font-family: 'Roboto', sans-serif; */
    .box-padding {
        font-family: 'Poppins', sans-serif !important;
        padding: 20px;
    }

    .box-padding h1 {
        font-size: 22px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif !important;
    }

    .bg-head {
        background: #ebdadc;
        font-weight: 600;
        /* border-left: 3px solid #99212e; */
    }

    a {
        text-decoration: none;
    }

    .btn-rss {
        padding: 7px;
        background: antiquewhite;
        border-radius: 4px;
        color: #a9914f;
    }

    .g-translate p {
        font-size: 12px;
        text-align: center;
    }

    .g-translate .form-select {
        font-size: 13px;
    }

    /* .head-btn {
        display: grid;
        justify-content: end;
    } */
    .head-btn .form-switch label {
        font-size: 14px;
    }

    .head-btn .form-switch {
        padding-left: 0px;
    }

    .login-box .d-flex label {
        flex: 0 16%;
    }

    .login-box .d-flex {
        align-items: center;
    }

    .login-box .login-items {
        display: grid;
        justify-content: center;
    }

    .login-box .login-items label {
        font-weight: 500;
    }

    .login-head-info {
        padding: 10px 20px;
        background: #f1edee;
        font-weight: 500;
        line-height: 20px;
        border-bottom: 2px solid #ccc;
        min-height: 82px;
    }

    .login-head-info p {
        margin: 0 0 5px 0;
    }

    .login-head-info a {
        color: #99212e;
    }

    .login-head-info a:hover {
        text-decoration: underline;
    }

    .login-error i {
        font-size: 50px;
        color: #99212e;
    }

    .login-error b {
        color: #99212e;
    }

    .login-box .bg-head p {
        font-size: 18px;
        letter-spacing: 0.5px;
    }
</style>

<body>
    <section>
        <div class="">
            @if (Session::has('failed'))
            <div class="box-padding" style="border-bottom: 3px solid #99212e;">
                <div class="row login-error">
                    <div class="col-md-2 text-end">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8">
                        <p class="m-0"><b>The username and password combination you entered did not match.</b>
                            If your email address is in the FlashAlert system as a contact,
                            you may use the tools below to recover your credentials.
                        </p>
                    </div>
                </div>
                @endif
                @if (session('error'))
                <div class="alert mb-0" style="border-bottom: 3px solid #99212e;">
                    <div class="row login-error">
                        <div class="col-md-2 text-end">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        </div>
                        {!! session('error') !!}
                    </div>
                </div>
                @endif
            </div>
            <div class="box-padding p-0">
                <div class="row login-box mx-0">
                    <div class="col-md-6 px-0">
                        <div class="box-padding bg-head">
                            <p class="mb-0"> FlashAlert Client Log In</p>
                        </div>
                        <div class="login-head-info">
                            <p>Not case sensitive. Two-minute timeout after five failed attempts</p>
                        </div>
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="box-padding login-items" style="border-right: 2px solid #ccc;">
                                <div class="py-3">
                                    <label class="form-label">Client User Name</label>
                                    <input style="background-color: #f1edee;" class="srch-form" type="text" id="" placeholder="Enter User Name" autocomplete="" name="email">
                                </div>
                                @error('email')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                <div class="py-3">
                                    <label class="form-label">Client Password</label>
                                    <input style="background-color: #f1edee;" class="srch-form" id="password" autocomplete="off" type="password" placeholder="password" name="password" required="">
                                </div>
                                @error('password')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                <span><input type="checkbox" id="showPass"> <strong id="showPassText">Show
                                        Password</strong></span>
                                <button class="srch-btn mt-3"><i class="fa fa-sign-in mx-2" aria-hidden="true" type="submit"></i> Login</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 px-0">
                        <div class="box-padding bg-head">
                            <p class="mb-0"><i>Or</i> Need a One Time Login Link?</p>
                        </div>
                        <div class="login-head-info">
                            {{-- <p>Not case sensitive. Two-minute timeout after five failed attempts.</p> --}}
                            <a href="{{ route('onetime.login') }}"> If your email address is in the FlashAlert system as an
                                org contact, look up your organization and send a one-time login to the two FA Newswire
                                contacts.</a>
                        </div>
                        <div class="box-padding bg-head">
                            <p class="mb-0"><i>Or</i> Use your Org's Facebook Login?</p>
                        </div>
                        <div class="login-head-info">
                            <p>If You Have Already Linked Your Newswire Account To Your Facebook Account,</p>
                            <div class="py-3 login-items">
                                <!-- <label class="form-label"><i>Must already be linked in account settings.</i></label> -->
                                <button class="srch-btn"><i class="fa fa-facebook-official mx-2" aria-hidden="true"></i>Login
                                    With Facebook</button>
                            </div>
                        </div>
                        <div class="login-head-info" style="margin-top:40px;">
                            <p style="font-size:18px; margin-bottom:10px;"><strong>Are you a FlashAlert Messanger
                                    subscriber?</strong></p>
                            <a href="{{ url('user-login') }}">Click here</a> to go to the Messanger login.
                        </div>
                    </div>
                </div>
            </div>

            <!--  <div class="box-padding p-0">
            <div class="row login-box mx-0">
                <div class="">
                    <div class="box-padding bg-head">
                        <p class="mb-0"><i>Or</i> Use your Org's Facebook Login?</p>
                    </div>
                    <div class="login-head-info">
                       <p>If You Have Already Linked Your Newswire Account To Your Facebook Account,</p>
                        <p class="m-0">If your email address is in the FlashAlert system as an org contact,
                            enter that email and an authentication link will be emailed to you.</p>
                    </div>
                    <div class="py-3 login-items" style="border-left: 2px solid #ccc;">
                        <label class="form-label"><i>Must already be linked in account settings.</i></label>
                        <button class="srch-btn"><i class="fa fa-facebook-official mx-2" aria-hidden="true"></i>Login
                            With Facebook</button>
                    </div>
                </div>
            </div>
        </div> -->
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="{{ url('public/js/custom.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#showPass').on('click', function() {
            togglePassword();
        });

        $('#showPassText').on('click', function() {
            togglePassword();
        });

        function togglePassword() {
            var passInput = $("#password");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
                $('#showPass').prop('checked', true);
            } else {
                passInput.attr('type', 'password');
                $('#showPass').prop('checked', false);
            }
        }
    });
</script>

</html>