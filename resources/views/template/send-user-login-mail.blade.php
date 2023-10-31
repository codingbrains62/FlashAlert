<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
 <style>
    table,
td,
div,
h1,
p {
    font-weight: 500;
    font-family: Arial, sans-serif;
}

.btn {
    margin: 10px 0px;
    border-radius: 4px;
    text-decoration: none;
    color: #fff !important;
    height: 46px;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 600;
    background-image: linear-gradient(to right top, #021d68, #052579, #072d8b, #09369d, #093fb0) !important;
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
                        <!-- <td align="left" style="padding:10px 25px;background:#fff; display: flex; align-items: center;">
                             <span style="font-weight: bold; padding-top: 10px;"> Flash Alert Newswire </span>
                        </td> -->
                        <td align="center"
                            style="    align-items: center;padding: 3px 334px;display: flex;background: #e4e5eb;justify-content: center;">
                            <img src="flashalert.projects-codingbrains.com/admin_assets/dist/img/FlashAlert-Icon.png"
                                alt="logo" style="padding:6px;">
                            <span style="font-weight: bold;font-size: 16px;color: #9b381b;margin: 4px 5px;"> Flash Alert Newswire
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr style="color: #3c3c3c;">
                                    <td style="padding:0;color:#153643;">
                                        <p style="font-weight: 600;font-size: 14px;font-family: 'Roboto'; color: #3c3c3c;">Welcome to FlashAlert Newswire. Your premium-tier account has been activated and is available for you to post emergency information and news releases.</p>
                                        <p style="margin:0 0 20px 0;font-family:'Roboto'; color: #3c3c3c;font-weight: 600;font-size: 14px;">
                                          Region: {{ $user ? $user['region'] : '' }},</h1>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:'Roboto';font-weight: 500;color: #3c3c3c;">
                                            We've received a request to Your Login Detials.
                                        </p>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:'Roboto';font-weight: 500;color: #3c3c3c;">
                                           This is Your Organization Name: <b style="text-decoration: underline;font-style: italic;letter-spacing: 0.6px;">{{ $user ? $user['name'] : '' }}</b>
                                        </p>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:'Roboto';font-weight: 500;color: #3c3c3c;">
                                           This is Your Username: <b style="text-decoration: underline;font-style: italic;letter-spacing: 0.6px;">{{ $user ? $user['username'] : '' }}</b> 
                                        </p>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:'Roboto';font-weight: 500;color: #3c3c3c;">
                                            Your custom FlashAlert page URL: <b>{{ $user ? $user['url'] : '' }}</b> 
                                        </p>
                                        <p style="margin:80px 0 12px 0;font-size:14px;font-family:'Roboto';font-weight: 500;">
                                        Your username and password are NOT case sensitive. Your emergency closure messages will be distributed into the websites of the news media that have requested it, including all the TV stations and many of the larger radio groups. News releases are emailed to media based on what cities are chosen</p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:'Roboto';font-weight: 500;">
                                        The shortcut to the login page is: https://flashalert.projects-codingbrains.com/IIN/login </p>
                                        <p style="margin:50px 0 12px 0;font-size:14px;font-family:'Roboto';font-weight: 500;">
                                        Late opening messages delete at 11 a.m. All-day emergency messages delete at 5 p.m. each day. If you post a message that you want to stay alive through the evening and next morning, please check the box that indicates that it is "For Tomorrow." </p>
                                        <p style="margin:50px 0 12px 0;font-size:14px;font-family:'Roboto';font-weight: 500;">
                                        Please remember to keep the information in your user account current, especially contact names and numbers. That allows me to contact you if necessary; enables you to have your username/password e-mailed to you if you forget them; and emails you a copy of what you post.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="text-align:center;background: #e4e5eb;">
                        <p
                            style="letter-spacing: 0.8px;font-weight: bold;font-family: 'Roboto';color: #9b381b;font-size: 16px;margin: 8px 0;">
                            © Flash Alert </p>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>