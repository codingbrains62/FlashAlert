<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('front_assets/images/FlashAlert-Icon.png') }}" rel="icon">
    <link href="{{ url('front_assets/images/FlashAlert-apple-touch.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;400&family=Poppins:ital,wght@0,100;0,400;0,500;0,700;1,400&family=Raleway:wght@200;300;500&family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">
    <title>FlashAlert Newswire</title>
</head>
<style>
    body {
        background: linear-gradient(to bottom, #d1c0c8 0%, #b5a5a6 99%) fixed;
    }

    section {
        background: #FFF;
        margin: 30px;
    }

    p {
        font-family: 'Poppins', sans-serif;
        text-align: justify;
        font-size: 14px;
    }

    /* font-family: 'Inconsolata', monospace;
    font-family: 'Poppins', sans-serif;
    font-family: 'Raleway', sans-serif;
    font-family: 'Roboto', sans-serif; */
    .box-padding {
        font-family: 'Poppins', sans-serif !important;
        padding: 20px;
    }

    .box-padding h1 {
        font-size: 22px;
        font-weight: 600;
        font-family: 'Roboto', sans-serif !important;
    }

    .bg-head {
        background: #ebdadc;
        font-weight: 600;
        /* border-left: 3px solid #99212e; */
    }

    a {
        text-decoration: none;
    }

    .btn-rss {
        padding: 7px;
        background: antiquewhite;
        border-radius: 4px;
        color: #a9914f;
    }

    .g-translate p {
        font-size: 12px;
        text-align: center;
    }

    .g-translate .form-select {
        font-size: 13px;
    }

    /* .head-btn {
        display: grid;
        justify-content: end;
    } */
    .head-btn .form-switch label {
        font-size: 14px;
    }

    .head-btn .form-switch {
        padding-left: 0px;
    }

    .login-box .d-flex label {
        flex: 0 16%;
    }

    .login-box .d-flex {
        align-items: center;
    }

    .login-box .login-items {
        display: grid;
        /* justify-content: start; */
    }

    .login-box .login-items label {
        font-weight: 500;
    }

    .login-head-info {
        padding: 10px 20px;
        background: #f1edee;
        font-weight: 500;
        line-height: 20px;
        border-bottom: 2px solid #ccc;
    }

    .login-head-info p {
        margin: 0 0 5px 0;
    }

    .login-head-info a {
        color: #99212e;
    }

    .login-head-info a:hover {
        text-decoration: underline;
    }

    .login-error i {
        font-size: 50px;
        color: #99212e;
    }

    .login-error b {
        color: #99212e;
    }

    .login-box .bg-head p {
        font-size: 18px;
        letter-spacing: 0.5px;
    }

    /* ========= New Styling ================ */
    .top-btn-a {
        padding: 15px;
        text-align: end;
        background: linear-gradient(to bottom, #d1c0c8 0%, #b5a5a6 99%) fixed;
    }

    .top-btn-a a {
        background: #99212e;
        color: #fff;
        font-size: 16px;
        display: inline-block;
        padding: 8px 10px;
        text-align: center;
        width: 135px;
        font-weight: 500;
    }

    .top-btn-a a .fa {
        margin: 0 4px;
    }

    .top-btn-a a:hover {
        color: #99212e;
        background: #fff;
        transition: ease-in 0.2s;
    }

    .srch-btn-log-info {
        background-color: #99212e;
        color: #fff;
        font-size: 14px;
        height: 36px;
        margin: 18px 10px;
        opacity: 1;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1.6px;
        border: none;
        border-radius: 0 4px 4px 0;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 12px 20px;
        position: relative;
        transform: perspective(1px) translateZ(0);
    }

    button.srch-btn-log-info:before {
        content: "";
        position: absolute;
        inset: 0;
        width: 100%;
        border-radius: 0 4px 4px 0;
        transform: scaleX(0);
        transform-origin: 100% 50%;
        transition-property: transform;
        transition-duration: 0.5s;
        transition: all 0.31s;
        transition-timing-function: ease-out;
        z-index: -1;
    }

    button.srch-btn-log-info:hover {
        opacity: 1;
        color: #fff !important;
    }

    button.srch-btn-log-info:hover:before {
        transform: scaleX(1);
        transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
        background-color: #61040e;
    }

    select option {
        font-size: 14px;
    }

</style>
<body>
    <div class="container">
        <section>
            <div class="top-btn-a">
                <a href="{{route('backend.signin')}}">Main Menu <i class="fa fa-backward" aria-hidden="true"></i></a>
                <a href="">Refresh <i class="fa fa-refresh" aria-hidden="true"></i></a>
                <a href="{{route('backend.signin')}}">Exit <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
            <div class="box-padding p-0">
                <div class="row login-box mx-0">
                    <div class="col-md-12 px-0">
                        <div class="box-padding bg-head">
                            <p class="mb-0"> Retrieve your Login Information:</p>
                        </div>
                        <div class="login-head-info">
                            <p>Username/Password Retrieval</p>
                        </div>
                        @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <p>Your login information has successfully been emailed to the 1 addresses on file.If you do not receive an email at your registered addresses please make sure
                                that you are whitelisting mail from info@flashalert.net (and check any junk mail folders).</p>
                            <p class="text-center"><a href="{{route('backend.signin')}}">Back To Login Screen</a></p>
                            <p class="text-center"><button class="srch-btn-log-info rstbtn">Reset</button></p>
                        </div>
                        @elseif (Session::has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <p>The Email is not registered.</p>
                            <p class="text-center"><a href="{{route('backend.signin')}}">Back To Login Screen</a></p>
                            <p class="text-center"><button class="srch-btn-log-info rstbtn">Reset</button></p>
                        </div>
                        @else
                        <form method="post" action="{{route('sendlogindetail')}}">
                            @csrf
                            <div class="box-padding login-items d-flex align-items-end justify-content-start" style="border-right: 2px solid #ccc;">
                                <div class="py-3" id="getorgdiv">
                                    <label class="form-label">Region:</label>
                                    <select class="form-select" aria-label="Default select example" style="width:500px;" id="getorg">
                                        <option selected value="">select your Region</option>
                                        @foreach($user as $users)
                                        <option value="{{$users->id}}">{{$users->Description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button class="srch-btn-log-info"><i class="fa fa-envelope mx-1" aria-hidden="true"></i> Send Email</button>
                                    <button type="reset" class="srch-btn-log-info rstbtn"><i class="fa fa-times mx-1" aria-hidden="true"></i> Cancel</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="{{ url('public/js/custom.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#getorg').on('change', function() {
            var id = this.value;
            //alert(val);
            var url = "{{route('getogron')}}"
            $.ajax({
                url: url
                , method: 'get'
                , data: {
                    id: id
                    , _token: '{{ csrf_token() }}'
                }
                , success: function(result) {
                    //alert(result);
                    $("#getorgdiv").html(result);
                }
            });
        });
        $(document).on('change', '#orgcategory', function() {
            var id = this.value;
            // alert(id);
            var url = "{{route('orgcategory')}}"
            $.ajax({
                url: url
                , method: 'get'
                , data: {
                    id: id
                    , _token: '{{ csrf_token() }}'
                }
                , success: function(result) {
                    //alert(result);
                    $("#getorgdiv").html(result);
                }
            });
        });
        $(document).on('click', '.rstbtn', function() {
            location.reload();
        });
    });
</script>
</html>
