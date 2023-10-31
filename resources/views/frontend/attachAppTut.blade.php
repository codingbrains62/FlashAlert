@extends('frontend.layouts.app')
@section('content')
<section>
    <div style="background: #c5e3ed">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="intro-box ">
                <div class="intro-text d-flex justify-content-center align-items-center">
                    <h1>ATTACH APP ISSUES</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container bank-union my-4">
        <p>While cell phone text messaging works fine in most instances, the cell companies get suspicious when they see a thousand of the same message coming at them, as in a snow situation, and sometimes set these messages aside for greater spam screening. A better alternative to texting is push notification, where the app on your mobile device creates a peer-to-peer relationship with the source of the information, in this case the FlashAlert server. The result is faster and more reliable delivery.</p>

        <p><b>Download the app</b><br>
            You will find the free FlashAlert Messenger app at <b><a href="https://play.google.com/store/apps/details?id=net.flashalert.messenger">https://play.google.com/store/apps/details?id=net.flashalert.messenger</a></b> and in the <b><a href="https://itunes.apple.com/us/app/flashalert-messenger/id545458058?ls=1&amp;amp;mt=8">https://itunes.apple.com/us/app/flashalert-messenger/id545458058?ls=1</a></b><b><a href="https://itunes.apple.com/us/app/flashalert-messenger/id545458058?ls=1&amp;amp;mt=8">&amp;amp;</a></b><b><a href="https://itunes.apple.com/us/app/flashalert-messenger/id545458058?ls=1&amp;amp;mt=8">mt=8 </a></b>iTunes app store. Download the app and install it on your phone or tablet. The first time you open it, the app will ask you to link to your existing FlashAlert Messenger account, or to go to the FlashAlert website and create an account and then link.</p>

        <p><b>Link the app</b><br>
            Linking the app to the account allows the app to receive push notifications from the organizations you have subscribed to on the web site, in the <b> quot;</b>My FlashAlert<b>quot; </b>tab. If you want to view information without linking, or are linked and want to see news posted by all of FlashAlert’s member organizations, there are tabs for <i>regional</i> emergency info and news releases.<br>
            If you have trouble linking your app to your existing FlashAlert account, please <b><a href="http://flashalertnewswire.net/attachbutton.html">http://flashalertnewswire.net/attachbutton.html </a></b>click here. And please note that if you get a new phone, you must delete the old one and add the new one (the notifications are sent based on the phone’s internal ID token, not the phone number).</p>

        <p><b>Be connected to receive your news</b><br>
            You must be connected to the Internet to receive push notifications or news feed. That connection can be through cell service or wi-fi connection.<br>
            In Android, if you get a message that you are not connected to the Internet, cycle your wifi off then on, and you should then be able to work off either network. The problem seems to be a conflict between the app and an operating system upgrade. We are working on an update to the app, but it requires a rebuild from the ground up.</p>

        <h3 class="txt-blu">Nothing happens when you click the “attach” button in the app?</h3>
        <p><b>When the <i>Attach My Account</i> button is unresponsive</b>, it’s because the phone is unable to acquire a push notification token. This token, from Apple’s Push Notification Service (APNS) or Google Cloud Messaging (GCM), is sent to FlashAlert when the account is attached, and is used to send push notifications to you.</p>

        <h3 class="text-center p-2 bg-grey-lite fw-bold"><a name="android"></a><i class="fa fa-android mx-1" aria-hidden="true"></i> Android Troubleshooting</h3>
        <p class="font-15">Make sure that the internet is accessible from your device.</p>
        <p class="font-15">If you are running a version older than Android 4.3 AND your device is on a network such as a corporate or school wireless connection you may need to check with your IT staff that they are not blocking outbound connections to port 5228, 5229 and 5230. Newer versions can use port 443.</p>

        <h3 class="txt-blu">Google Account Enabled</h3>
        <p class="font-15">If you are running an older version of Android (prior to version 4.0.4) you will need a Google account enabled on your device.</p>
        <p class="font-15">Generally if you installed FlashAlert Messenger with Google Play, you should already be set.</p>
        <p class="font-15">The example below is for a Android 4.0.3 tablet. Your own setup may vary slightly.</p>

        <p class="mb-1"><b>1) Open Settings</b></p>
        <p class="font-15">From the home screen, bring up your settings by tapping on the clock, and then pressing on the gear icon.<br>
            Alternatively, you should also be able to find your settings under the full list of apps on the device.</p>
        <figure>
            <img decoding="async" class="img-fluid" src="/public/front_assets/images/attachAppFix/android-fix-1.png" alt="" width="640" height="400">
        </figure>

        <p class="mb-1"><b>2) Accounts sync</b></p>
        <p class="font-15">Find the Accounts  Sync tab. It should be under the Personal section.</p>

        <p class="mb-1"><b>3) Add Account </b></p>
        <p class="font-15">If your Google account is not listed under accounts, click the Add Account button.</p>
        <figure>
            <img decoding="async" class="img-fluid" src="/public/front_assets/images/attachAppFix/android-fix-2.png" alt="" width="640" height="400">
        </figure>

        <p class="mb-1"><b>4) Select Google </b></p>
        <p class="font-15">Select Google from the list of account types./</p>
        <figure>
            <img decoding="async" class="img-fluid" src="/public/front_assets/images/attachAppFix/android-fix-3.png" alt="" width="640" height="400">
        </figure>

        <p class="mb-1"><b>5) Enter Account Credentials</b></p>
        <p class="font-15">Enter your login and password for your Google account.</p>

        <p class="mb-1"><b>6) Save Options </b></p>
        <p class="font-15">You can leave this unchecked if you do not want to back your device up with your Google account. Press Next.</p>
        <figure>
            <img decoding="async" class="img-fluid" src="/public/front_assets/images/attachAppFix/android-fix-4.png" alt="" width="640" height="400">
        </figure>

        <p class="mb-1"><b>7) Complete</b></p>
        <p class="font-15">Your Google account should now be listed.</p>
        <p class="font-15">You can also try hard-restarting FlashAlert Messenger and/or rebooting your device if this fails to help.</p>
        <figure>
            <img decoding="async" class="img-fluid" src="/public/front_assets/images/attachAppFix/android-fix-5.png" alt="" width="640" height="400">
        </figure>

        <h3 class="text-center p-2 bg-grey-lite fw-bold"><a name="android"></a><i class="fa fa-apple mx-1" aria-hidden="true"></i> iPhone / iOS Troubleshooting</h3>

        <p class="font-15">If your Push Notifications are disabled in your iPhone settings, you will be unable to link your account.</p>

        <p class="mb-1"><b>1) Open Settings </b></p>
        <p class="font-15">From your iPhone home screen, find the Settings icon (looks like a gear). Find FlashAlert in the list of apps and click on it.</p>
        <figure>
            <img decoding="async" class="img-fluid ios-img" src="/public/front_assets/images/attachAppFix/ios-fix-1.png" alt="" width="640" height="400">
        </figure>

        <p class="mb-1"><b>2)  Click on “Notifications.” </b></p>
        <figure>
            <img decoding="async" class="img-fluid ios-img" src="/public/front_assets/images/attachAppFix/ios-fix-2.png" alt="" width="640" height="400">
        </figure>
        <p class="font-15">(The lower screen settings are up to the user’s preferences, but “Allow Notifications” needs to be on. “Use Cellular Data” should be on as well, so you can attach your app to your account and get notifications while outside wi-fi range.)</p>

        <p class="mb-1"><b>3)  Click on “Allow Notifications.”</b></p>
        <p>If this screen looks like this, you’ll need to turn on “Allow Notifications.”</p>
        <figure>
            <img decoding="async" class="img-fluid ios-img" src="/public/front_assets/images/attachAppFix/ios-fix-3.png" alt="" width="640" height="400">
        </figure>
        <p class="font-15">The other settings on this screen may be set at your discretion:</p>
        <figure>
            <img decoding="async" class="img-fluid ios-img" src="/public/front_assets/images/attachAppFix/ios-fix-4.png" alt="" width="640" height="400">
        </figure>
        <p class="font-15">Make sure that the phone is connected to Internet. If your settings look correct and you still don’t attach, try rebooting the phone by powering it off and on. As a last resort, try deleting the app and reinstalling it.</p>

    </div>
</section>
@endsection