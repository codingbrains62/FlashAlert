@extends('frontend.layouts.app')
@section('content')
    <?php
    //echo"<pre>";
    // print_r($data);
    //die;
    ?>
    <style>
        .SubscribeEmail {
    margin-bottom: 15px;
} 
    </style>
    <section>
        <div style="background: #c5e3ed">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="intro-box ">
                    <div class="intro-text d-flex justify-content-center align-items-center">
                        <h1>Signup</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container bank-union my-4">
            <div id="content">
                <div id="content-core">
                    <div id="main">
                        <div id="main-core">
                            {{-- <div class="ErrorMessage">This email address already is associated with an account. <a
                                    href="{{ route('messengersub.login') }}">Click here to log in</a>.<br>
                            </div> --}}
                            @if ($errorMessage)
                                <div class="alert alert-danger">
                                    {{ $errorMessage }} <a
                                    href="{{ route('messengersub.login') }}">Click here to log in</a>.<br>
                                </div>
                            @else
                            <div class="alert alert-success">
                                "Please check that the email addresses you entered match.<br>
                                Set a password of four or more letters/numbers, not case sensitive."
                            </div>
                        @endif
                            <div class="SubscribeEmail">
                                <form action="{{ route('messSubscribeManage') }}" method="post">
                                    @csrf
                                    <label for="EmailAddress" class="mb-2"><b>Email Address</b></label>
                                    <input type="text" value="{{ $data['EmailAddress'] }}{{ old('EmailAddress') }}"
                                        name="EmailAddress" class="srch-form">
                                    @error('EmailAddress')
                                        <div class="text-danger">
                                            {{ str_replace('The email address has already been taken.', 'This email address already is associated with an account.', $message) }}
                                            <a href="{{ route('messengersub.login') }}">Click here to log in.</a>
                                        </div>
                                    @enderror
                                    <label for="EmailAddress" class="mb-2"><b>Confirm Email Address</b></label>
                                    <input type="text" name="ConfirmEmailAddress" class="srch-form">
                                    @error('ConfirmEmailAddress')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="PW" class="mb-2"><b>Password (Min. 4 characters, not case
                                            sensitive)</b></label>
                                    <input type="password" name="NPW" class="srch-form">
                                    @error('NPW')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="PW" class="mb-2"><b>Confirm Password</b></label>
                                    <input type="password" name="confirm_password" class="srch-form">
                                    @error('confirm_password')
                                        <div class="text-danger">
                                            {{ str_replace('The confirm password and n p w must match', 'The confirm password and password must be same', $message) }}
                                        </div>
                                    @enderror
                                    <input type="hidden" value="{{ optional($data)['OrgID'] ?? old('OrgID') }}" name="OrgID">
                                    <input type="hidden" value="{{ optional($data)['NewsSub'] ?? old('NewsSub') }}"
                                        name="NewsSub">
                                    <input type="hidden" value="{{ optional($data)['EmergSub'] ?? old('EmergSub') }}"
                                        name="EmergSub">
                                    {{-- <input type="hidden" value="" name="OrgID"> --}}
                                    <input type="submit" name="Submit" value="Create your Account">
                                </form>
                            </div>
                            <div class="">
                                <ul>
                                    <li><strong>With the proliferation of spam and the resulting spam filters, it is
                                            impossible to guarantee message delivery, since different filters block
                                            different messages, and ISPs and cell companies may delay messages.<br>
                                        </strong>
                                        <p></p>
                                    </li>
                                    <li>All addresses registered on FlashAlert will remain confidential.
                                    </li>
                                    <li>Each summer, you will receive a message at your primary email address asking if
                                        you wish to continue your subscription. <br>
                                        Therefore, please keep your addresses up to date.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
