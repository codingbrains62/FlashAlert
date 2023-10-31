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
                    style="width:600px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;">
                        <!-- <td align="left" style="padding:10px 25px;background:#fff; display: flex; align-items: center;">
                             <span style="font-weight: bold; padding-top: 10px;"> Flash Alert Newswire </span>
                        </td> -->
                        <td align="left"
                            style="padding:10px 230px; display: flex; align-items: center;justify-content: center;background: #e4e5eb;">
                            <img src="https://flashalert.projects-codingbrains.com/admin_assets/dist/img/FlashAlert-Icon.png"
                                alt="logo" style="pading:6px;">
                            <span style="font-weight: bold;font-size: 16px;color: #9b381b;margin: 4px 5px;"> Flash Alert Newswire
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:0 0 20px 0;font-family:Arial,sans-serif;">
                                           Hello {{ $user ? $user['name'] : '' }},</h1>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                            We've received a request to Your Login Detials.
                                        </p>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                           This is Your Username: <b>{{ $user ? $user['name'] : '' }}</b>
                                        </p>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                           This is Your Password: <b>{{ $user ? $user['password'] : '' }}</b> 
                                        </p>
                                        <p style="margin:100px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Flash Alert Newswire </p>
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