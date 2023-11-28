<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/front_assets/css/my.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;400&family=Poppins:ital,wght@0,100;0,400;0,500;0,700;1,400&family=Raleway:wght@200;300;500&family=Roboto:wght@300;500;700&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
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

    .skiptranslate.goog-te-gadget {
        position: absolute;
        top: 165px;
        right: 280px;
    }
</style>

<body id="translate">
    <section class="emergency-msg">
        {{-- @if (Session::has('success'))
            <script>
                swal({
                    title: "Done!",
                    text: "{{ Session::get('success') }}",
                    icon: "success",
                    timer: 3000
                });
            </script>
            <!-- <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
            {{ Session::get('success') }}
        </div> -->
        @elseif (Session::has('failed'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ Session::get('failed') }}
            </div>
        @endif --}}
        <div class="">
            <div class="box-padding" style="border-bottom: 3px solid #99212e;">
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-xl-6">
                        <h1>{{ $data[0]->Name }}</h1>
                    </div>
                    <div class="col-md-7 col-lg-7 col-xl-6">
                        <!-- <div class="head-btn">
                            <div>
                                <p class="mb-0"> Follow our emergency messages on <a href="" class="btn-rss">RSS</a></p>
                            </div>
                                <div class="form-check form-switch mt-2">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">New information
                                        alert <b>ON</b></label>
                                    <input style="float:right;" class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" />
                                </div>
                        </div> -->
                        <div class="row head-btn">
                            <div class="col-md-5 col-lg-6 col-xl-7 d-flex">
                                <p class="mb-0 mx-2"> Follow our emergency messages on</p> <a href=""
                                    class="btn-rss">RSS</a>
                            </div>
                            <div class="col-md-7 col-lg-6 col-xl-5">
                                <div class="form-check form-switch d-flex pl-0 justify-content-between">
                                    <label class="form-check-label px-2" for="flexSwitchCheckDefault">New information
                                        alert <b>ON</b></label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="box-padding bg-head">
                <?php
                $dateTime = new DateTime('now', new DateTimeZone('GMT')); // 'now' gets the current time
                $currentPDTTime = $dateTime->format('g:i A, D. M j');
                ?>
                {{-- <a href="" class="text-muted">View our emergency closure guidelines.</a> --}}
                <p class="mb-0">Emergency Messages as of <?php echo $currentPDTTime; ?></p>
            </div>
            <div class="box-padding">
                <div class="row">
                    <div class="col-md-7">
                        <p>No information currently posted.</p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-2 g-translate">
                        {{-- <select class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Language</option>
                            <option value="1">Chinies</option>
                            <option value="2">French</option>
                            <option value="3">German</option>
                        </select>
                        <p class="my-1">Powered by
                            <img
                                src="https://www.gstatic.com/images/branding/googlelogo/1x/googlelogo_color_42x16dp.png"
                                alt="translate"> translate</p> --}}
                        <script>
                            // function loadGoogleTranslate(){
                            //     new google.translate.TranslateElement('translate')
                            // }
                            function loadGoogleTranslate() {
                                new google.translate.TranslateElement({
                                    pageLanguage: 'en',
                                    includedLanguages: 'zh-CN,fr,de,ja,ko,ru,es,vi',
                                    //layout: google.translate.TranslateElement.InlineLayout.SIMPLE, 
                                    autoDisplay: false,
                                }, 'translate');
                            }
                        </script>
                    </div>
                    <div class="col-md-3 text-center">
                        <figure>
                            @if (isset($logo[0]))
                                <img src="{{ $logo[0]->ThumbURL }}" height="300" width="300" class="img-thumbnail">
                            @endif
                            <!--  <img src="https://flashalertnewswire.net/images/logo/6866/thumb_WVCI-believe_rgb.jpg.jpg"
                                alt="logo"> -->
                        </figure>
                    </div>
                </div>
            </div>
            @if ($data1[0]->FlashAlertSubscriber == 1)
                <div class="box-padding bg-head">
                    <p class="mb-0">Subscribe to receive FlashAlert messages from {{ $data[0]->Name }}.</p>
                </div>

                <form action="{{ route('messSubscribe') }}" method="post">
                    @csrf
                    <div class="box-padding">
                        <div class="search-bar emg-srch">
                            <label class="form-label">Primary email address for a new account</label>
                            <div class="d-flex flex-wrap">
                                <input type="hidden" name="OrgID" value="{{ $data[0]->id }}">
                                <input class="srch-form" type="text" name="EmailAddress" id="searchInput"
                                    placeholder="Enter Email..." autocomplete="off">
                                <div class="d-flex align-items-center emg-mail-check">
                                    <div class="form-check form-check-inline mx-2">
                                        <input class="form-check-input" type="checkbox" name="EmergSub"
                                            id="inlineCheckbox1" value="1" checked>
                                        <label class="form-check-label" for="inlineCheckbox1">Emergency Alerts</label>
                                    </div>
                                    <div class="form-check form-check-inline mx-2">
                                        <input class="form-check-input" type="checkbox" name="NewsSub"
                                            id="inlineCheckbox2" value="1" checked>
                                        <label class="form-check-label" for="inlineCheckbox2">News Releases</label>
                                    </div>
                                </div>
                                <button type="submit" class="srch-btn">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- @if ($data1[0]->FlashAlertSubscriber == 1) --}}
                <div class="box-padding bg-head">
                    <p class="mb-0">News Release</p>
                </div>
                <div class="box-padding">
                    <div class="row">
                        {{-- pressrelease table data --}}
                        <div class="col-md-8">
                            <h1 class="my-3">WVCI First in Lane County to offer TrueBeam Radiotherapy
                                <em>12/02/2002</em>
                            </h1>

                            <p><b>Willamette Valley Cancer Institute and Research Center on the Forefront of Cancer
                                    Treatment with the TrueBeam® Radiotherapy System from Varian</b> </p>
                            <p>
                                <b> Medical Systems</b> <br>
                                Fast, powerful, accurate technology enables an advanced standard of precision in cancer
                                treatment
                            </p>

                            <p><b>Eugene, OR., April 3, 2023 —</b> In a promising development for cancer patients in
                                Lane
                                County, Willamette Valley Cancer Institute and Research Center (WVCI) announced today
                                that
                                it has begun treating patients on a newly acquired TrueBeam® radiotherapy system. The
                                first
                                of its kind in Lane County, the TrueBeam expands options, especially for complex cancer
                                cases.</p>

                            <p><i>“Thanks to our great team, the machine runs flawlessly. It allows us to treat some
                                    patients, such as those with very small brain tumors, that we otherwise would not be
                                    able to treat at WVCI</i> - .” – Dr. Merideth Wendland, M.D.</p>

                            <p><b>Enhanced Precision</b></p>
                            <p>TrueBeam® technology was engineered to deliver powerful cancer treatments with speed and
                                pinpoint accuracy measured in millimeters. The system targets tumors with tremendous
                                precision made possible by synchronizing imaging, beam shaping, and dose delivery. As a
                                patient is lying stationary, the linear accelerator moves smoothly and quietly around
                                them
                                delivering a pain-free treatment while performing accuracy checks every ten milliseconds
                                to
                                ensure extreme precision.</p>

                            <p><b>Faster Treatment</b></p>
                            <p>The TrueBeam system integrates state-of-the-art imaging, “intelligent” automation, and
                                motion
                                management technologies to deliver treatments more quickly while monitoring patient
                                beathing
                                and compensating for tumor motion during treatment to reduce dose to healthy tissues.
                            </p>

                            <p>For more information on radiation therapy please visit <a
                                    href="">www.oregoncancer.com/radiation-therapies</a></p>

                            <p>For more information on Willamette Valley Cancer Institute and Research Center please
                                visit
                                <a href="">www.oregoncancer.com</a>
                            </p>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                {{-- @endif --}}
        </div>
        @endif
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="{{ url('public/js/custom.js') }}"></script>

</html>
