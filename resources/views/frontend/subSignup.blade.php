@extends('frontend.layouts.app')
@section('content')
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
                            <div class="ErrorMessage">This email address already is associated with an account. <a
                                    href="{{ route('messengersub.login') }}">Click here to log in</a>.<br>
                            </div>
                            <div class="SubscribeEmail">
                                <form method="post" action="">
                                    <label for="EmailAddress" class="mb-2"><b>Email Address</b></label>
                                    <input type="text" value={{$data['EmailAddress']}} name="EmailAddress" class="srch-form" required>
                                    <label for="EmailAddress" class="mb-2"><b>Confirm Email Address</b></label>
                                    <input type="text" name="EmailAddress" class="srch-form" required>
                                    <label for="PW" class="mb-2"><b>Password (Min. 4 characters, not case
                                            sensitive)</b></label>
                                    <input type="password" name="PW" class="srch-form" required>
                                    <label for="PW" class="mb-2"><b>Confirm Password</b></label>
                                    <input type="password" name="PW" class="srch-form" required>
                                    <input type="hidden" value="Subscribe" name="UpdateSub">
                                    <input type="hidden" value="1" name="SubNews">
                                    <input type="hidden" value="1" name="SubEmergency">
                                    <input type="hidden" value="4" name="OrgID">
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
