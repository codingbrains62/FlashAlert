@extends('frontend.layouts.app')
@section('content')
<style>
    a {
        text-decoration: none;
    }

    .loginColor a,
    .loginColor a i {
        color: red;
    }
    .loginColor a i.fa{
        color: #3498DB;
    }
    .alreadylog {
        /* Your CSS styles for the 'alreadylog' class here */
        font-weight: bold;
        color: #FF0000;
        /* Red color as an example */
    }

    .alreadylog strong {
        /* Your CSS styles for the <strong> element inside 'alreadylog' class here */
        font-style: italic;
        text-decoration: underline;
    }
    /* --------------------- */
    .dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 4px 8px;
  font-size: 12px;
  border: none;
  cursor: pointer;
}

.cst-drp.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.cst-drp .dropdown-content a:hover {background-color: #ddd;}

.cst-drp.dropdown:hover .dropdown-content {display: block;}

</style>
<section>
    <div style="background: #c5e3ed">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="intro-box ">
                <div class="intro-text d-flex justify-content-center align-items-center">
                    <h1>{{ $postnewsRegion }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div id="content">
        <div id="content-core">
            <div id="main">
                <div id="main-core">
                    <div class="table-responsive iconTbl-mh">
                        <table class="table tbl-info-client">
                            <tbody>
                                <tr>
                                    <td class="loginColor">
                                        @if (Session::has('loginId'))
                                        <p class="mb-0"><strong>Already Logged in</strong>
                                            <br><span class=""><a class="clk-here-btn" href="https://flashalert.projects-codingbrains.com/IIN/dashboard">
                                                    Click
                                                    here</a> to go to dashboard</span>
                                        </p>{{-- Optionally, you can show a popup here --}}
                                        @else
                                        <a href="javascript:void(0)" rel="noopener noreferrer">
                                            <i class="fa-solid fa-right-to-bracket fa-2xl"></i></a><br>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Log In/Create Account
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                                                    <li><a class="dropdown-item" href="{{ route('backend.signin') }}"><i class="fa fa-right-to-bracket mx-1"></i> Log In</a></li>
                                                    <li><a class="dropdown-item" href="{{ url('IIN/addnewuser') }}"><i class="fa fa-user-plus mx-1"></i> Create Account</a></li>
                                                </ul>
                                            </div>
                                        <!-- <a href="https://flashalert.projects-codingbrains.com/IIN/login"
                                                    target="_blank" rel="noopener noreferrer" class="fw-6">Log In/Create Account</a> -->
                                        @endif
                                    </td>
                                    <td><a href="http://www.flashalertportland.net/closures-cats.html" target="_blank" rel="noopener noreferrer"><i class="fa-regular fa-clipboard fa-2xl"></i></a><br><a class="fw-6" href="http://www.flashalertportland.net/closures-cats.html" target="_blank" rel="noopener noreferrer">View Current Info</a>
                                    </td>
                                    <td><a href="http://forecast.weather.gov/MapClick.php?site=pqr&amp;smap=1&amp;textField1=45.52361&amp;textField2=-122.675#.Una3VCRQ1Ug" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-cloud-sun fa-2xl"></i></a><br><a class="fw-6" href="http://forecast.weather.gov/MapClick.php?site=pqr&amp;smap=1&amp;textField1=45.52361&amp;textField2=-122.675#.Una3VCRQ1Ug" target="_blank" rel="noopener noreferrer">Portland Forecast</a></td>
                                    <td><a href="http://www.tripcheck.com/Pages/RCMap.asp?mainNav=RoadConditions&amp;curRegion=1" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-road fa-2xl"></i></a><br><a class="fw-6" href="http://www.tripcheck.com/Pages/RCMap.asp?mainNav=RoadConditions&amp;curRegion=1" target="_blank" rel="noopener noreferrer">Road Conditions</a>
                                    </td>
                                    <td><a href="{{ asset('tutorial.pdf') }}" target="_blank" rel="noopener"><i class="fa-solid fa-chalkboard fa-2xl"></i></a><br><a class="fw-6" href="{{ asset('tutorial.pdf') }}" target="_blank" rel="noopener">Tutorial
                                            (PDF)</a>
                                    </td>
                                    <td><a href="{{ route('blog') }}"><i class="fa-solid fa-book fa-2xl"></i><br><span class="fw-6">Enhancements</span></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="container bank-union mb-4">
                        {!! @$postnews[0]->post_news_region_data !!}
                        @if (@$postnews[0]->post_news_region_id == 1)
                        @if (Session::has('loginId'))
                        <p class="mb-0 alreadylog"><strong>Already Logged in</strong>
                            <br>
                        </p>{{-- Optionally, you can show a popup here --}}
                        @else
                        <p><a href="{{ url('IIN/addnewuser') }}">Register here for the basic service,</a> if you
                            meet the minimum size requirement.</p>
                        @endif
                        <p><strong>2. The <em>premium</em> tier is for groups that meet the size requirements below,
                                as well as all government offices, police departments, etc.</strong></p>
                        <p>Like the basic service, the information you post is placed on media websites. It is
                            delivered to <strong>all</strong> newsrooms (TV, radio, daily/weekly newspapers) for
                            on-air use and TV screen crawls. This tier includes access to news release distribution,
                            account customization to reach people other than the media (Business Partners) and the
                            optional FlashAlert Messenger system detailed below. Private schools, post-secondary
                            schools and organizations must have at least 125 students/participants, and businesses
                            must have at least 125 employees or daily customer traffic.<br>
                            @if (Session::has('loginId'))
                            <strong class="mb-0 alreadylog"><strong>Already Logged in</strong>
                            </strong>{{-- Optionally, you can show a popup here --}}
                            @else
                            <br>
                            <strong><a href="{{ url('IIN/addnewuser') }}" target="_blank" rel="noopener noreferrer">Register here for the <em>premium</em>
                                    service</a>,
                            </strong>if you meet the minimum size requirement.
                            @endif
                        </p>
                        <p>To protect your organization from false reports, your account must be authenticated –
                            which may take several hours – so please register in advance of needing the service. No
                            service is available for fewer than 40 people.</p>
                        @endif
                        <h4><strong>Information is distributed to the news media in three ways.</strong></h4>
                        <ol>
                            <li>Your information posts into a page for the media <a href="{{ $postnews[0]->site_url }}" target="blank"> ({{ $postnews[0]->site_name }}) </a>as soon as it is received. The
                                media monitor the page, which refreshes every 10 minutes. When their browser detects new
                                information during a reload, it puts an alert on the screen, even if the page is
                                minimized. This page also has links to a search function to locate contact info for
                                FlashAlert clients and other tools.</li>
                            <li>New or changed information is emailed to newsrooms at the addresses they provide every
                                15 minutes on busy days, and immediately for single events.</li>
                            <li>Every 10 minutes, the info is “pushed” into news media web sites and TV crawls or
                                “tickers.” The information appears on their web page, where the public can view it.
                                Click here for an example of TV station use. At the end of the day, the system deletes
                                the information and subscribers may begin placing information regarding the next day.
                                Postings made the previous night can be flagged that they pertain to the next day and
                                are <strong>not</strong> deleted that night.</li>

                        </ol>
                        <p>The public can see your information on a page for just your org, which you can link to. The
                            optional FlashAlert Messenger (see below) allows you to send emergency messages and news
                            releases directly to parents, staff, students and others at the same time as the media.</p>
                        <p>A new tool allows you to record a sound bite or full video to accompany your news release.
                        </p>
                        <h4><strong>• Emergency Information: What is appropriate for FlashAlert?</strong></h4>
                        <p>In weather situations, clients can begin at a web page where they can view the real-time
                            status of other organizations. After logging in and posting, they get a confirmation email.
                            FlashAlert provides the news media with <b>local, accurate, time-sensitive information that
                                impacts a large number of people</b>. Airtime is in great demand during emergency
                            situations.
                            The news media will air information they deem appropriate; you will have greater success if
                            you give them only what you really need to communicate.</p>
                        <h4><strong>• News Releases: For your everyday news</strong></h4>
                        <P>FlashAlert’s second “channel” distributes non-urgent news releases. You choose which cities
                            you wish your releases to be sent to. You can upload photos or PDFs or even a video clip.
                            You can have a text preview emailed to yourself or anyone else you choose.</P>
                        <p>Newsrooms get hundreds of emails per day; FlashAlert helps them filter this mail and see
                            items from local organizations first. The news releases are available on an archive web
                            page. You also can save a release as a draft, and even schedule it for future delivery.</p>
                        <p>FlashAlert distributes to all media – radio, TV and daily/weekly newspapers – in the cities
                            you choose.</p>
                        <p style="font-weight: 400; text-align: center;">
                            <strong>_____________________________________</strong>
                        </p>

                        <h4><strong>Customization and Your Organization’s Own Page</strong></h4>
                        <p>You can add into your account the e-mail addresses of “Business Partners” – people whom you
                            would like to receive your emergency message and news release (in addition to the news
                            media). And any time an organization’s name shows up to the media, it is as a link to the
                            organization’s home page, enabling the media to quickly get to your site.</p>
                        <p>If you have a Facebook or Twitter account, FlashAlert can post your emergency messages to
                            your feeds. If you manually delete a message in FlashAlert, it also is removed from FB/TW.
                            If the message reaches its delete time, the message stays on your page.</p>
                        <p>Each organizations has a page with their FlashAlert information. On this page are your
                            emergency messages and news releases and a starting point for a FA Messenger subscription,
                            if the org has opted in. No more need to update your own news web page – just link to it
                            from your home page. Click&nbsp;<a href="#" target="_blank" rel="noopener noreferrer">here</a>&nbsp;to see the page for Oregon State Police.</p>
                        <h4><strong>FlashAlert Messenger: News direct to the Public</strong></h4>
                        <p><em>FA Messenger</em>&nbsp;is a companion service where the public, including parents,
                            employees and students may self-register up to three email addresses and receive your
                            information at the same time as the news media. When someone registers, they trigger test
                            messages to make sure they’ve entered addresses correctly and that messages pass spam
                            filters. Each summer, an opt-in message is sent to keep the database current. Text message
                            addresses are discouraged due to the delays caused by cell companies and them truncating
                            messages.</p>
                        <p>Even faster is the free iOS/Android app FlashAlert Messenger, which allows the public to
                            receive push notifications of your emergency messages – much faster and more reliable than
                            text messaging. They also can view all emergency items and news releases in their region.
                        </p>
                        <p>If you want to get more specific, you can add sub-organizations that your constituents can
                            subscribe to. A school district, for example, could make each school a sub-org. In fact,
                            FlashAlert allows you to add a sub-org third level, so you could send news about a specific
                            school’s PTO or Band Boosters. A police department might set up sub-orgs for their
                            precincts, and be able to target news releases to people subscribed to that precinct, as
                            well as the news media. You also can create an account or sub-account that limits
                            subscribers to those who have a specific email suffix, in the event you want to keep some
                            communications restricted (such as messaging employees about when to report).</p>
                        <p>There is no charge to the public for the Messenger service; the annual cost to an
                            organization is 20¢ per subscriber for the first 1,000, then 10¢ per subscriber thereafter.
                            Click&nbsp;<a href="{{ route('sampletext') }}" target="_blank" rel="noopener noreferrer">here</a>&nbsp;for
                            sample text you can use to explain to the public how to sign up for FlashAlert Messenger.
                        </p>
                        <p>We discourage text messages, in favor of push notifications through the free Messenger app.
                            If someone simply must get a text message, they can enter their phone manually using their
                            cell company’s suffix (AT&amp;T for example might be 8005551212@txt.att.net).</p>
                        <h4><a href="javascript:void(0)"><strong>New Premium Tool: News Media
                                    Monitoring</strong></a></h4>
                        <h5><em><strong>FlashAlert distributes your news.<br>
                                    It now SHOWS YOU THE RESULTS!</strong><br>
                            </em></h5>
                        <p>Now included in your FlashAlert premium subscription at no additional cost is media
                            monitoring by Your News Inc.</p>
                        <p>FlashAlert and YNI have partnered for several years, but now, your premium subscription to
                            FlashAlert includes free local TV/Radio/Newspaper/Online media reports showing exactly where
                            your news was used (for clients new to YNI). &nbsp;Additional YNI services are available to
                            FA clients at a greatly reduced rate.</p>
                        <p>Here is a sample report for Portland Police: &nbsp;<a href="{{ route('monitoring.Report') }}">{{ route('monitoring.Report') }}</a>
                        </p>
                        <p>Ashley Massey with the Oregon State Marine Board uses both services.</p>
                        <p>“We use FlashAlert to distribute the agency’s news releases to specific media outlets,
                            depending on the target audience and area where we’re hoping to get coverage,” she says.
                            “FlashAlert is a one-stop portal to easily distribute important local or statewide news to
                            media outlets and subscribers about, for example, “all things recreational boating.”</p>
                        <p>Similarly, YNI is a one-stop portal that captures the media outlets who shared news releases
                            or other media stories using key terms and words important for the client. Together, these
                            portals provide an A-to-Z solution for your outbound news and inbound media coverage. You
                            control news that goes out to the public (via FlashAlert) and what news actually gets
                            reported (via Your News Inc). Your News Inc’s portal also enables the end user to view, edit
                            and archive tv and radio segments.</p>
                        <p>On your account management page, you’ll find a checkbox to activate Media Monitoring.
                            &nbsp;Once you click &nbsp;this,&nbsp;<a href="http://yournewsinc.net/">YourNewsInc.net</a>&nbsp;will contact you for the
                            information needed to start providing you with your free local media monitoring reports and
                            tell you about statewide and national monitoring options also available.</p>
                        <h4><strong>Speed and Reliability</strong></h4>
                        <p>News editors prefer emails, since the info can be forwarded and copy/pasted. They are faster
                            than faxes, more accurate than phone calls. FlashAlert is redundant in that stations can see
                            information online as it is posted or through the e-mails every 15 minutes.</p>
                        <p>While FlashAlert resides on a group of servers with multiple power supplies, the Internet is
                            an unregulated medium and performance cannot be guaranteed. Also, subscribers should take
                            into account the reliability of their own Internet service provider (ISP) through which they
                            access the network, as well as their home/office power supply. The FlashAlert web sites are
                            tested every 20 minutes by an independent monitoring company.</p>
                        <h4><strong>Open Rates</strong></h4>
                        <p>FlashAlert does not generate open rates, the percentage of emails that are actually opened
                            and, presumably, read. Open rates are based on putting an invisible, one-pixel graphic in
                            the news release. The idea is that when someone opens the email, it calls for the graphic
                            and the request is logged. But many mail clients (including my own) no longer call for the
                            graphic unless you tell it to. Therefore, the open count is greatly skewed lower. And many
                            reporters ignore the email and get the info off the FA website. Between these two factors,
                            the count ends up much lower than it should be and of no help.</p>
                        <h4><strong>Management</strong></h4>
                        <p>FlashAlert has managed emergency communications for the school districts in the Portland area
                            for 44 years, starting with phone calls, then faxes. In 2000, the Internet created the
                            opportunity to bring in other regions and organizations. Users benefit from easy access to
                            the news media, while the news media benefit from having an organized, information
                            clearinghouse. The automated nature of the network keeps costs low.</p>
                        {{-- <p>Here’s who is using FlashAlert in Portland:&nbsp;<a
                                    href="{{ route('participants.list') }}">Participant list</a></p> --}}
                        <form method="post" action="{{ route('participants.list') }}">
                            @csrf
                            <input type="hidden" name="participants" value="{{ $postnews[0]->post_news_region_id }}">
                            Here’s who is using FlashAlert in Portland:&nbsp;<button class="btn participant">Participant list </button>
                        </form>
                        <h4><strong>Cost</strong></h4>
                        <p>Click on the link and choose your region to see annual fees for unlimited use
                            (September-August billing cycle, pro-rated after November 1).&nbsp;<a href="{{ route('feestructure.list', ['id' => $postnews[0]->post_news_region_id]) }}">View
                                fee schedule.</a></p>
                        {{-- <form method="post" action="{{route('feestructure.list')}}">
                        @csrf
                        <input type="hidden" name="feeschedule" value="{{$postnews[0]->post_news_region_id}}">
                        Click on the link and choose your region to see annual fees for unlimited use
                        (September-August billing cycle, pro-rated after November 1).&nbsp;
                        <button class="btn btn-link">
                            <p>View fee schedule.</p>
                        </button>
                        </form> --}}

                        <h4 style="text-align: center;"><strong>Renewal by credit card</strong></h4>
                        <p class="text-center fw-bold"><a href="https://zohosecurepay.com/checkout/8wkrz69-zhaj5jyg9zd0k/FlashAlert-Newswire" target="_blank" rel="noopener">Make a Payment</a>
                        </p>
                        <h4 class="text-center"><strong>Try It!</strong></h4>
                        <p class="fw-4 text-center">Take FlashAlert for a test drive. Click&nbsp;
                            <a href="{{ route('flashalert.info', ['id' => $postnews[0]->post_news_region_id]) }}">here</a>&nbsp;for
                            a “dummy” zone.
                        </p>
                        @if (@$region->Tier2Enabled == 0)
                        <p class="text-center">To register for FlashAlert, <a href="http://www.flashalertnewswire.net/IIN/index.html?Menu=signup" target="_blank" rel="noopener noreferrer">start here.</a>
                        </p>
                        @endif
                        {{-- <form method="post" action="{{ route('flashalert.info') }}" class="fw-4 text-center">
                        @csrf
                        <input type="hidden" name="dzones" value="{{ $postnews[0]->post_news_region_id }}">
                        Take FlashAlert for a test drive. Click&nbsp;
                        <button class="btn btn-link">
                            <p>here.</p>
                        </button>for a “dummy” zone.
                        </form> --}}

                        <h4 style="text-align: center;"><strong>Policies</strong></h4>
                        <p style="font-weight: 400; text-align: center;">Click&nbsp;<a href="https://flashalert.projects-codingbrains.com/policies">here</a>&nbsp;to see
                            policies for Privacy, Refunds and Terms and Conditions.</p>
                        <h4 style="text-align: center;">For more info about FlashAlert Newswire, use the form below or
                            contact<br>
                            Craig Walker, Founder and Customer Care Agent,&nbsp; 971 ** 772 ** 1850</h4>
                        <div class="barcode-contact d-flex justify-content-around my-3">
                            <div><img decoding="async" class="centerit alignnone img-fluid" src="{{ asset('front_assets/images/2C4512EF-CD68-4CAE-B776-07B0458402B9-300x287.jpeg') }}" width="220" height="auto">
                            <h4>And yes, that is a river of lava 15 feet behind me in Iceland!</h4>
                        </div>
                           <div>
                                <img decoding="async" class="centerit alignnone img-fluid" src="{{ asset('front_assets/images/craig-contact.png') }}" width="215" height="auto">
                                <h4 class="text-center">Scan for contact info!</h4>
                           </div>
                        </div>
                        <!-- <h4 style="text-align: center;">And yes, that is a river of lava 15 feet behind me in Iceland!
                        </h4> -->

                        <div class="news_form cst-send-msg">
                            @if (session('success'))
                            <div id="success-message" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <!-- JavaScript to scroll to the success message -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const successMessage = document.getElementById('success-message');
                                    if (successMessage) {
                                        successMessage.scrollIntoView({
                                            behavior: 'smooth'
                                        });

                                        // Automatically remove the success message after 5 seconds (5000 milliseconds)
                                        setTimeout(function() {
                                            successMessage.style.display = 'none';
                                        }, 5000);
                                    }
                                });
                            </script>
                            <form action="{{ url('/submit-form') }}" method="post" class="">
                                @csrf
                                <h3 class="send-head">Send a Message to FlashAlert
                                </h3>
                                <div class="form-group mb-3">
                                    <label for="firstNameInput" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstNameInput" placeholder="Enter first name">
                                    @error('firstName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="emailInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="emailInput" placeholder="Enter email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="descriptionInput" class="form-label">Description</label>
                                    <textarea class="form-control" id="descriptionInput" name="description" rows="3"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-5 text-center">
                                    <button type="submit" class="srch-btn ">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection