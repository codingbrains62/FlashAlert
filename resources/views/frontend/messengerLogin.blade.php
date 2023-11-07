@extends('frontend.layouts.app')
@section('content')
    <section>
        <div style="background: #c5e3ed">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="intro-box ">
                    <div class="intro-text d-flex justify-content-center align-items-center">
                        <h1>Login</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div id="content-core">

                <div id="main">
                    <div id="main-core">

                        <form class="log-input front-login" method="post" action="{{ route('mesSubLogin') }}">
                            @csrf
                            <label for="EmailAddress" class="mb-2"><b>Email Address</b></label>
                            <input placeholder="E-mail" type="text" id="EmailAddress" name="EmailAddress"
                                class="srch-form" required>
                            @error('EmailAddress')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if (session()->has('failed'))
                            <div class="text-danger">
                                {{ session('failed') }}
                            </div>
                            @endif                        
                            <!-- <br> -->
                            <label for="PW" class="mb-2"><b>Password (Min. 4 characters, not case
                                    sensitive)</b></label>
                            <input placeholder="Password" type="password" id="PW" name="NPW" minlength="4"
                                class="srch-form" required>
                            <!-- <br> -->
                            @error('NPW')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <span>
                                <label class="my-3">
                                    <input type="checkbox" id="showPassword" title="Not recommended in public areas."
                                        onchange="togglePasswordVisibility()">
                                    Show Password
                                </label>
                            </span>
                            <button type="submit" name="Submit" class="srch-btn">Login</button>
                            <b class="text-center my-2"><a href="{{ route('frontend-lostpass') }}">Click here</a> to reset
                                your password</b>
                        </form>
                        <hr>
                        <!-- <p>Reset your Password: <a href="">Click here.</a></p> -->
                        <p>Create new account: <a href="{{ route('frontend-region') }}">Click here,</a> then choose your
                            region, then the org.
                        </p>
                        <p>Send Test: If you missed an email, log in to your account and launch a test message to ensure
                            messages are getting through spam filters, etc.</p>
                        <p>Emails not reaching you? If you are missing emails from FlashAlert, please whitelist
                            “info@flashalert.net”</p>
                        <p>Having trouble attaching the FlashAlert app? <a title="Attachment issue"
                                href="{{ route('attach-app-tut') }}" target="_blank" rel="noopener">Click here</a>.</p>
                        <p>
                        </p>
                        <p>Support: If you still have trouble, <a href="mailto:flashalert@projects-codingbrains.com">Email
                                support</a>.</p>
                        <p>
                        </p>
                        <p>Reporters: Contact <a href="mailto:flashalert@projects-codingbrains.com" target="_blank"
                                rel="noopener">FlashAlert</a> to be added to the master media list.</p>
                        </p>
                        <p>Email Tip: <a href="">Should you get a “forever” email address?
                            </a></p>
                        <p>
                        </p>
                        <p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('PW');
            var showPasswordCheckbox = document.getElementById('showPassword');

            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
@endsection
