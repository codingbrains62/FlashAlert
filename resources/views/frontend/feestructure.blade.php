<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            box-sizing: border-box;
            background-color: #bbdae5;
        }

        .content-wrapper h1 {
            font-size: 24px;
            color: #3b5161;
        }

        .content-inner {
            background: #ffffff;
            padding: 10px 15px;
            font-size: 14px;
            border: solid 1px #C5CBB5;
        }

        .content-wrapper {
            background: #c5e3ed;
            padding: 15px 15px;
            min-height: 600px;
            height: 100%;
            box-shadow: 0px 0px 15px rgb(0 0 0/ 15%);
            margin: 20px 0;
        }

        .content-inner table tr th {
            border-bottom: solid 2px #009e21;
        }

        .logo img {
            max-width: 200px;
            margin: 20px 0;
        }

        .nav.navigation a {
            font-weight: 500 !important;
            font-size: 14px !important;
            text-decoration: none !important;
            text-transform: uppercase !important;
            color: #ffffff !important;
            margin: 0 12px 0 0 !important;
            padding: 5px 10px;
            background: #20292c1c;
        }

        .nav.navigation a:hover {
            background: #1d3239c2;
        }

        .scroll-txt marquee {
            color: #fff;
            font-weight: 400; 
            font-size: 14px;           
        }
        .scroll-txt{
            background: #000;
        }

        /* Media Query */
        @media(max-width:991px) {
            .nav.navigation a {
                margin: 0 4px 0 0 !important;
            }
        }

        @media(max-width:767px) {}


        @media(max-width:567px) {
            .nav.navigation a {
                margin: 5px 12px 0 0 !important;
                width: -webkit-fill-available;
            }
        }
    </style>
</head>

<body>
    <div class="scroll-txt">
        <div class="container">
            <marquee>There are no emergency messages to display currently for this region.</marquee>
        </div>
        
    </div>
    <div class="container">
        <div class="header-Wrapper">
            <div class="logo">
                <a href="#"><img src="/public/front_assets/images/FlashAlert_a_logo.png"></a>
            </div>
            <div class="nav navigation">
                <a href="#">HOME</a>
                <a href="#">View Local News</a>
                <a href="#">Manage Your Messages</a>
                <a href="#">Post Your News</a>
                <a href="#">For News Media</a>
            </div>
        </div>
        <div class="content-wrapper">
            <h1>FlashAlert Newswire Membership Dues for {{$region->Description}}</h1>
            <div class="content-inner table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <th>Yearly Fee</th>
                        </tr>
                        <tr>
                            <td>test</td>
                            <td>213</td>
                        </tr>
                        <tr>
                            <td>Medical</td>
                            <td>$180</td>
                        </tr>
                        <tr>
                            <td>Utilities</td>
                            <td>$180</td>
                        </tr>
                        <tr>
                            <td>Police &amp; Fire</td>
                            <td>&lt;25 patrol officers/firefighters $160/year; 25-75 $210; &gt;75 $260</td>
                        </tr>
                        <tr>
                            <td>Transportation</td>
                            <td>$170</td>
                        </tr>
                        <tr>
                            <td>Federal</td>
                            <td>$190</td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>$240</td>
                        </tr>
                        <tr>
                            <td>Counties/Regional</td>
                            <td>$170</td>
                        </tr>
                        <tr>
                            <td>Cities</td>
                            <td>$160 under 50,000 pop.; over: $250</td>
                        </tr>
                        <tr>
                            <td>Courts</td>
                            <td>Paid by state</td>
                        </tr>
                        <tr>
                            <td>Colleges &amp; Universities</td>
                            <td>$210 public; $160 private</td>
                        </tr>
                        <tr>
                            <td>Deschutes/Crook/Jefferson Co. Schools</td>
                            <td>&lt;1K students: $160. 1K-8K: $210. &gt;8K: $260</td>
                        </tr>
                        <tr>
                            <td>Umatilla &amp; Morrow Co. Schools</td>
                            <td>&lt;1K students: $160. 1K-8K: $210. &gt;8K: $260</td>
                        </tr>
                        <tr>
                            <td>Wheeler &amp; Grant Co. Schools</td>
                            <td>&lt;1K students: $160. 1K-8K: $210. &gt;8K: $260</td>
                        </tr>
                        <tr>
                            <td>Charter and Private Schools</td>
                            <td>$150</td>
                        </tr>
                        <tr>
                            <td>Banks &amp; Credit Unions</td>
                            <td>$220</td>
                        </tr>
                        <tr>
                            <td>Businesses</td>
                            <td>$180</td>
                        </tr>
                        <tr>
                            <td>Organizations</td>
                            <td>$130</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>