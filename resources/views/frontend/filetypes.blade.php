@extends('frontend.layouts.app')
@push('title')
File Types Available - FlashAlert Newswire & Messenger
@endpush
@section('content')
<section>
    <div class="bg-blu-cover">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="intro-box ">
                <div class="intro-text d-flex justify-content-center align-items-center">
                    <h1>FILE TYPES AVAILABLE</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container bank-union my-4">
    <h2>Using FlashAlert files in your station or newspaper’s website and/or CGS</h2>
    <h3>Files for automatic placement in your website</h3>
    <p>FlashAlert can automatically place a file into your server containing all the latest data. Through FTP, the file is replaced every five minutes. Information can be provided in a generic HTML style, tab-delimited form, CSV, JSON, RSS or as an XML file you can parse. Here is what the HTML version of the file looks like on a <a href="http://www.katu.com/weather/closings" target="_blank" rel="noopener noreferrer">station website.</a></p>
    <p>Please note that FlashAlert does not allow “hotlinking” to its site. It is acceptable for stations to periodically pull reports from FlashAlert (every 5 to 15 minutes) if FTP is not available; however you need to cache and re-display this information to your site visitors instead of sending them directly to our servers via hot-linking or iframing FlashAlert report pages.</p>
    <h3>Files that can automatically populate your TV station CGS</h3>
    <p>FlashAlert has two XML data feeds available. One contains all of the data: emergencies, news releases and participants. The other, designed for use in TV CGS, has only the emergency postings. Here is the <a href="http://www.craigwalker.net/IIN/reportsX/flashnews_xml2.php" target="_blank" rel="noopener noreferrer">complete XML</a> file for the Portland area, select View Source. This is the <a href="http://www.craigwalker.net/IIN/reportsX/flashnews_xml_emergency.php" target="_blank" rel="noopener noreferrer">emergency-only XML</a> file.</p>
    <p>The XML files have data fields that will allow you to parse the info for CGS use. Here is a sample XML file and a description of what the tags mean:</p>
    <p>&lt;<strong>flashnews updated</strong>=”2012-08-14 03:12:18″&gt;<br>
    &lt;<strong>emergency</strong>&gt;<br>
    &lt;<strong>emergency_category name</strong>=”Central Co. Schools”&gt;<br>
    &lt;<strong>emergency_report report_id</strong>=”26940″ <strong>effective_date</strong>=”2012-08-14 15:08:40″ updated=”0″ <strong>last_update</strong>=”2012-08-14 15:08:50″ <strong>testing</strong>=”0″ <strong>schoolrelated</strong>=”1″ <strong>orgid</strong>=”413″ <strong>custom</strong>=”0″ <strong>operating_code</strong>=”5″ <strong>transpo_code</strong>=”20″&gt;<br>
    &lt;<strong>detail</strong>&gt;&lt;![CDATA[2 hrs late, Buses on snow rts]]&gt;&lt;/detail&gt;<br>
    &lt;<strong>tomorrow</strong>&gt;&lt;![CDATA[Effective tomorrow – Wed Aug 15th]]&gt;&lt;/tomorrow&gt;<br>
    &lt;<strong>orgname orgid</strong>=”413″ <strong>tier</strong>=”1″ <strong>zipcode</strong>=”x”&gt;&lt;![CDATA[Cityville Schools]]&gt;&lt;/orgname&gt;<br>
    &lt;/emergency_report&gt;<br>
    &lt;/emergency_category&gt;<br>
    &lt;/emergency&gt;&lt;/flashnews&gt;</p>
    <p><strong>Field/Element/Attributes descriptions:</strong></p>
    <p><strong>flashnews updated</strong>: Time the information was posted or last changed<br>
    <strong>emergency</strong>: Type of info (emergency, news release, sports)<br>
    <strong>emergency_category name</strong>: The grouping, i.e. schools, police, military<br>
    <strong>emergency_report report_id</strong>: A unique number for this incident, stays constant if the info is updated<br>
    <strong>effective_date</strong>: The time the report was first published<br>
    <strong>updated</strong>: 0 indicates the report has not been updated since first posting; 1 means it has<br>
    <strong>last_update</strong>: The time when the report was last altered<br>
    <strong>testing</strong>: For FlashAlert’s use<br>
    <strong>schoolrelated</strong>: 1 means the report pertains to a district, private school or college. 0 means it is non-school (police, military, city, etc.)<br>
    <strong>orgid</strong>: an org’s unique ID number<br>
    <strong>custom</strong>: 0 means that the message was built using preconfigured messages, and thus does not need human review before going to CGS. 1 indicates that the message was handwritten and needs to be reviewed.<br>
    <strong>operating_code, transpo_code</strong>: for use in the Seattle region only<br>
    <strong>detail</strong>: the me<span class="oneColElsCtr">ssage</span><br>
    <strong>tomorrow</strong>: if message has been marked for the next day, that day will show. This field will go empty at midnight.<br>
    <strong>orgname orgid</strong>: same as orgid above<br>
    <strong>tier</strong>: In Portland and Colorado Springs, gives 1 for premium tier, 2 for basic tier. This function segregates larger orgs, which need to go to CGS, from smaller ones, which go only to the web.<br>
    <strong>zipcode</strong>: Zip of the address associated with the org’s registration.</p>
    <p><em><strong>To FTP files into your website or CGS, FlashAlert needs the server address, any folder you wish to have the file go into, a username and password.</strong></em></p>
    <p>&nbsp;</p>
    <p><strong>Seattle TV stations:</strong> Click <a href="http://www.craigwalker.net/seattlestatuscodes.doc" target="_blank" rel="noopener noreferrer">here</a> for a doc with Seattle-only status code descriptions and org ID numbers.</p>
    <p>&nbsp;</p>
    <p><a href="javascript:void(0)">&lt; Return to previous page</a></p>
    </div>
</section>
@endsection