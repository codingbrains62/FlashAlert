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
                        <td align="left" style="padding:10px 25px;background:#fff; display: flex; align-items: center;">
                             <span style="font-weight: bold; padding-top: 10px;"> Hello {{$user['region']}} </span>
                        </td>
                       
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr style="color: #3c3c3c;">
                                    <td style="padding:0;color:#153643;">
                                           
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:'Roboto';font-weight: 500;color: #3c3c3c;">
                                            
                                            <a href="{{ url('http://127.0.0.1:8000/user-login-link/'.$user['name'].'/'.$user['region']) }}"
                                                class="btn btn-link">Please click on this link to validate this address for receiving FlashAlerts. </a>
                                        </p>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:'Roboto';font-weight: 500;color: #3c3c3c;">
                                            Or, log into your account at <a href="https://flashalert.projects-codingbrains.com/messenger-login">FlashAlert</a> and enter your password, then enter the code: <b>{{$user['name']}}</b>
                                        </p>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:'Roboto';font-weight: 500;color: #3c3c3c;">
                                            Your action is required to complete your registration. Unvalidated addresses do not receive alerts</b> 
                                        </p>
                                      
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