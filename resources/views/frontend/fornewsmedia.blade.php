<style>
    hr {
        background-color: #302f2f;
        border: 0;
        height: 1px;
        margin-bottom: 1.5em;
    }
</style>
@extends('frontend.layouts.app')
@section('content')
<section>
    <div class="bg-blu-cover">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="intro-box ">
                <div class="intro-text d-flex justify-content-center align-items-center">
                    <h1>FOR NEWS MEDIA</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container bank-union my-4">
        <h2>Organizations have breaking news to pass on to newsrooms.</h2>
        <p>They can call newsrooms with their info — if you’ve got the personal to take the calls — or email it to you or post on social media and hope you see it, mixed in with everything else. At certain times of the year, such as during a winter storm or after an earthquake, everyone is trying to reach newsrooms at the same time. Wouldn’t it be better to be able to post information in one place and have a system that passes it on immediately in an organized fashion to all of the media as well as the public?</p>
        <p>That’s the idea behind FlashAlert Newswire. The system collects emergency information and news releases from thousands of organizations – including schools, colleges, businesses, hospitals, utilities, cities, military — and provides it to print, radio and TV media by three methods.</p>
        <h3>Methods of Distribution</h3>
        <ol>
        <li><strong>Web page:</strong> Each region’s media page (listed below) displays the information within one minute of being received. Stations are encouraged to monitor the page, which refreshes every 10 minutes. It has a built-in alarm that flashes the browser tab and plays a tone with the arrival of new emergency information, even if the page is minimized. The page sorts by category by default; you may toggle it to view by message type or in reverse chronological order (useful on a busy day when you just want to see the latest info coming in).</li>
        <li><strong>Email:</strong> Every 10 minutes, the latest emergency information is e-mailed newsrooms. News releases are sent immediately. Emails can be sent to as many people in your newsroom as you wish. Are your email addresses up to date in FlashAlert? Click here, select your region, then city, and if you need to make changes, please email <a href="mailto:codingbrans62@gmail.com"> update@FlashAlert.net</a>.</li>
        <li><strong>File transfer:</strong> Also every 10 minutes, all information is pushed into participating news media websites, where the public can view it. Media receive the info in HTML, or XML or RSS format, at no cost. <a href="{{URL('file-types')}}">Click here</a> for a description of the types of files available for your station website and/or on-screen graphics (crawl).</li>
        </ol>
        <p>At 11 a.m., emergency messages pertaining to late openings delete. At 5 p.m., the rest of the day’s emergency info deletes and subscribers begin placing information regarding the next day, for use in 6, 10 and 11 p.m. television newscasts. (Organizations may post information for the next day by check boxing “For Tomorrow” and that information stays alive through the night and next day.) News releases stay available to the media for one month.</p>
        <p>The region media report pages have some new tools. <em>Contacts</em> allows you to select a FA client and see contact info for the two contacts. <em>Sponsored Content</em> has additional information provided by third parties. <em>Search</em> allows you to look for a specific news release or do a general search.</p>
        <p>FlashAlert has managed emergency communications for the school districts in the Portland-Vancouver area for 44 years and now covers all of the NW and Colorado Springs. There is no cost to the media and schools and organizations pay an annual fee ranging from $150 to $250 to post news.</p>
        <p><strong>The Portland region alone has nearly 1,000 member organizations, including all police and fire agencies in the region. To see how two Portland stations use the emergency information FlashAlert automatically posts into their websites, visit <a href="http://www.katu.com/weather/closings">KATU TV</a>.</strong></p>
        <hr>
        <div class="report-links">
            <p>Region report pages for News Media</p>
            <div>
                <a href="http://www.flashalertportland.net">www.flashalertportland.net</a>
                <a href="http://www.flashalerteugene.net">www.flashalerteugene.net</a>
                <a href="http://www.flashalertmedford.net">www.flashalertmedford.net</a>
                <a href="http://www.flashalertbend.net">www.flashalertbend.net</a>
                <a href="http://www.flashalertseattle.net">www.flashalertseattle.net</a>
                <a href="http://www.flashalertcolumbia.net">www.flashalertcolumbia.net</a>
                <a href="http://www.flashalertspokane.net">www.flashalertspokane.net</a>
                <a href="http://www.flashalertboise.net">www.flashalertboise.net</a>
                <a href="">www.flashalert.net/xxxx (combo page)</a>
            </div>
        </div>
        <div style="text-align: center;">
            <figure class="aligncenter size-full">
                <img decoding="async" width="537" height="349" class=""
                    src="{{ asset('front_assets/images/USAmapButtons2GotNews.jpeg') }}" alt srcset=""
                    sizes="(max-width: 537px) 100vw, 537px">
            </figure>
        </div>
	</div>
</section>
@endsection