<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="Refresh" content="600">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width, target-densityDpi=medium-dpi">
    <title>FlashNews</title>
    <style type="text/css">
        #cwcReportContainer {
            background-color: #FFF;
        }

        #cwcReportBody {
            border-left: 1px solid #CCC;
            border-right: 1px solid #CCC;
            border-bottom: 1px solid #CCC;
        }

        #cwcReportSubHeader {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 0.7em;
            padding: 2px;
            border-bottom: 1px solid #CCC;
        }

        #cwcReportHeader {
            color: #FFF;
            font-family: Tahoma, Verdana, Arial, sans-serif;
            font-size: 12pt;
            padding: 5px;
            background-color: #006699;
            text-align: center;
            font-weight: bold;
            border: 1px solid #4C4C4C;
        }

        #cwcReportSubHeader a {
            color: #333;
            text-decoration: none;
        }

        #cwcReportFooter {
            border-top: 1px solid #CCC;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 0.7em;
            padding: 2px;
            background-color: #EEE;
            text-align: right;
            color: #CCC;
        }

        #cwcReportFooter a {
            color: #333;
            text-decoration: none;
        }

        .cwcReport {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 0.8em;
            margin-left: 10px;
            padding: 2px;
        }

        .cwcReport strong {
            color: #333;
        }

        .cwcReportCat {
            padding: 5px;
            background-color: #EBEBEB;
            border-bottom: 1px solid #CCC;
            font-family: Tahoma, Verdana, Arial, sans-serif;
            font-weight: bold;
            font-size: 1.0em;
        }
    </style>
    <style type="text/css">
        @font-face {
            font-weight: 400;
            font-style: normal;
            font-family: circular;

            src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Book.woff2') format('woff2');
        }

        @font-face {
            font-weight: 700;
            font-style: normal;
            font-family: circular;

            src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Bold.woff2') format('woff2');
        }
    </style>
</head>

<body>
    <div id="cwcReportContainer">
        <div id="cwcReportHeader">
            {{$region->Description}} Emergency Info for {{ \Carbon\Carbon::now('CST')->format('D. M. j - g:i a') }}
            {{-- {{$region->Description}} Emergency Info for {{ \Carbon\Carbon::now('UTC')->format('D. M. j - g:i a') }} --}}
        </div>
        <div id="cwcReportBody">
            <div id="cwcReportSubHeader">
                <div style="float:left;"><a href="{{ route('participants.list') }}"
                        target="_blank">Breaking news from local organizations.</a></div>
                <div style="float:right;"><a href="https://flashalert.projects-codingbrains.com/" target="_blank">Info provided by
                        FlashAlert Newswire</a></div>
                <div style="clear:both;"></div>
            </div>
            <div class="cwcReport">No information reported.</div>
        </div>
    </div><br><br>
    <div id="loom-companion-mv3" ext-id="liecbddmkiiihnedobmlmillhodjkdmb">
        <section id="shadow-host-companion"></section>
    </div>
</body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>
