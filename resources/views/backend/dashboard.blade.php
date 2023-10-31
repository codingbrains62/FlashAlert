@extends('backend.layouts.backapp')
@section('title', 'Dashboard')
@section('content')
    
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        @if ($data[0]->bActivated != 0)
            <section class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="info-box" style="padding:18px;">
                            <h2 class="blu" style="text-decoration: underline;">Welcome to FlashAlert Newswire & FAQs</h2>
                            <p>FlashAlert has collected and distributed school weather closure information to the news media
                                for 44 years. With
                                the arrival of the Internet two decades ago, the system grew from 60 school districts in
                                Portland to more than
                                2,000 users across the NW and in Colorado Springs.
                            </p>
                            <p>To make the system useful year-round, FlashAlert added a channel for news releases. Nearly
                                every police and fire
                                agency, from Longview to Medford, now use FlashAlert. In Portland, we distribute 30-40 news
                                releases a day.
                            </p>
                            <p>Messages are delivered via email, a web page that the media works from, and files pushed into
                                news media
                                websites.
                            </p>
                            <p>Some organizations allow the public to self-subscribe to their emergency messages and/or news
                                releases.
                                FlashAlert Messenger delivers those messages to subscribers via email, and push
                                notifications through the FA
                                Messenger app for iOS and Android.
                            </p>
                            <h2 class="blu" style="text-decoration: underline;">FAQs </h2>
                            <strong>What is FlashAlert?</strong>
                            <p>FlashAlert is a platform for distributing press releases and closure notifications. It helps
                                organizations of all sizes efficiently share emergency updates and news releases with the
                                media and the public.</p>
                            <strong>What are the two service tiers?</strong>
                            <p>FlashAlert has two service tiers:</p>
                            <ul>
                                <li><strong>Basic Tier:</strong> This tier is for small organizations, daycares, etc. It is
                                    limited to organizations with 40 or more members or daily customers. Basic allows you to
                                    post emergency messages.</li>
                                <li><strong>Premium Tier:</strong> The premium tier introduces more tools, such as
                                    non-urgent news release distribution.</li>
                            </ul>
                            <strong>How do I submit a press release or closure notification?</strong>
                            <p>Once logged in to your FA account, you’ll find options to “Post Closure or Emergency Report”
                                and “Post News Release (non-emergency).”</p>
                            <strong>Is there a cost or limit associated with submitting press releases or closure
                                notifications?</strong>
                            <p>Outside of the annual subscription fee to FlashAlert, there is no cost or limit for
                                submitting press releases or emergency notifications.</p>
                            <strong>How long does it take for a submitted press release or closure to be published?</strong>
                            <p>Press releases and emergencies are sent immediately.</p>
                            <strong>Can I schedule the release of a news release for a future date?</strong>
                            <p>Absolutely! If you’d like to schedule a release in advance, you can easily do so from the
                                editor by selecting “Save as Draft or Send Later,” set the date and time for release at the
                                top of the screen and hit Update.</p>
                            <strong>What types of organizations use FlashAlert?</strong>
                            <p>Any organization, whether corporate, nonprofit, government, or educational, can use this
                                platform to distribute press releases and closure notifications. FlashAlert handles news
                                distribution for ODOT, OSP and nearly all police.</p>
                            <strong>How will my press release or closure notification be distributed?</strong>
                            <p>Your press release will be distributed through our network, which includes all media outlets,
                                online platforms,
                                and subscribers who have opted to receive updates from us. The media get emails, can view
                                the info on a webpage,
                                and the info is pushed into media websites and crawls.</p>
                            <strong>Can I edit a press release after it has been published?</strong>
                            <p>Yes. You can easily reopen the press release and correct the mistake. You can choose to
                                re-send the corrected release to recipients again, or just hit Update to correct the release
                                on the website without re-sending to the audience.</p>
                            <strong>How do closure notifications work on FlashAlert?</strong>
                            <p>Closure notifications are used to inform the public and media about temporary closures due to
                                inclement weather or other conditions. Once submitted, the closures are sent directly to the
                                media including local television news affiliates where your organization’s closure will
                                appear on the scroll at the bottom of the screen (premium tier).</p>
                            <strong>How can I stay updated on press releases and closure notifications from other
                                organizations?</strong>
                            <p>Using your free FlashAlert Messenger account, you can subscribe to receive email
                                notifications, text alerts, or app push notifications about new press releases and closures.
                                You can also explore our website to find press releases and emergency notifications from
                                orgs all across the NW.</p>
                        </div>
                    </div>
            </section>
        @else
            <section class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <div class="info-box bg-red" style="padding:18px;">
                            <h2 class="blu">Welcome to Flash Alert</h2>
                            <h2>This account is on standby.
                            </h2>
                            <p>You will be unable to post until your account is activated by an administrator, which may
                                take an hour or two.
                                For assistance, please contact support@flashalert.net
                            </p>
                        </div>
                    </div>
            </section>
        @endif
    </div>
    <script>
        jQuery(document).ready(function() {
            // query to always open the global admin sidebar
            var alwaysOpen = jQuery(".always-open");
            var cstOpnMenu = jQuery(".cst-opn-menu");
            var hoverDown = jQuery(".cst-hover-down");

            alwaysOpen.addClass("menu-open");
            cstOpnMenu.css("display", "block");
            // qury to show sidebar options on hover
            jQuery(".hover-show").hover(function() {
                jQuery(this).addClass("menu-open");
                jQuery(this).find(" .cst-hover-show").slideDown("slow");
            }, function() {
                jQuery(this).removeClass("menu-open");
                // $(this).find(" .cst-hover-show").slideUp("slow");
            });
            jQuery(hoverDown).hover(function() {
                jQuery(this).addClass("menu-open");
                jQuery(this).find("ul").slideDown("slow");
            })
        });
    </script>
@endsection
