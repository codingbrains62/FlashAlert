<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-weight: 500;
            font-family: Arial, sans-serif;
        }
        .btn {margin: 10px 0px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff !important;
            height: 46px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            background-image: linear-gradient(to right top, #021d68, #052579, #072d8b, #09369d, #093fb0) !important;
        }
        .btn:hover {
            text-decoration: none;
            opacity: .8;
        }
    </style>
</head>
<body style="margin:0;padding:0;">
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;">
                    <td align="center"
                            style="    padding: 10px 350px; display: flex; background: #e4e5eb; justify-content: center;">
                            <img src="{{ asset('front_assets/images/FlashAlert-Icon.png') }}"
                                alt="logo" style="pading:6px;">
                            <span style="font-weight: bold;font-size: 16px;color: #9b381b;margin: 4px 5px;"> Flash Alert
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:0 0 20px 0;font-family:'Roboto'; font-size: 14px;">
                                        Greetings. This address receives news and weather closure information from FlashAlert Newswire. When orgs submit news or weather forces closures, watch for emails that pertain to Baker City, or for a complete list of closures, go to {{$user['SiteURL']}} . Listed below are the addresses for your newsroom. Please take a look at the information and reply to this email with changes or a simple "OK."</p>
                                        <p style="margin:0 0 12px 0;font-size: 14px;font-family:'Roboto';">
                                        FlashAlert sends you news and closures from school districts, colleges and private schools in the Bend/Central Oregon area as well as from other organizations, such as police and fire agencies, cities, etc. Here is a list of the schools and orgs you will hear from: www.flashalertbend.net/participants.html
                                        </p>
                                        <p style="margin:0 0 12px 0;font-size: 14px;font-family:'Roboto';">
                                        Have a great fall and winter and please let me know of any changes below as well as any suggestions you have for the system!
                                        </p>
                                        <p style="margin:70px 0 12px 0;font-size: 14px;font-family:'Roboto';">
                                        Best,<br>
                                        Craig Walker<br>
                                        www.flashalert.projects-codingbrains.com/<br>
                                        971-772-1850  Bend OR </p>
                                        <p style="margin:0 0 12px 0;font-size: 14px;font-family:'Roboto';">
                                        This is the information currently on file for your newsroom, PLEASE REPLY TO UPDATE OR CONFIRM: </p>
                                        <p style="margin:0 0 12px 0;font-size: 14px;font-family:'Roboto';">
                                        CITY GROUPING:<br>
                                        {!!$user['CityName'] !!}</p>
                                        <p style="margin:0 0 12px 0;font-size: 14px;font-family:'Roboto';">
                                        STATION(S)/NEWSPAPER:<br>
                                        {{ $user['Name']}}</p>
                                        <p style="font-size:14px;font-family:'Roboto';">CONTACT INFORMATION:</p>
                                        <p style="font-size:14px;font-family:'Roboto';">EMAIL RECIPIENTS AND TYPE OF NEWS:</p><br>
                                        @foreach($user['mail'] as $usermail)
                                        {{$usermail->Address}} --@if($usermail->EmergencyEmail==1)  Emergency @else News Releases  @endif <br>
                                        @endforeach
                                        <!-- <p>codingbrains32@gmail.com - News Releases</p>
                                        <p>codingbrains62@gmail.com - Emergency</p> -->

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="text-align:center;background:#e4e5eb">
                        <td><p style="letter-spacing:0.8px;font-weight:bold;font-family:'Roboto';color:#9b381b;font-size:16px;margin:8px 0">
                            © <span class="il">Flash</span> <span class="il">Alert</span> </p>
                    </td></tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>