@extends('frontend.layouts.app')

@section('content')
    <style>
        .info-select {
            padding: 7px 10px;
            width: 37%;
            font-weight: 600;
            color: #727272;
            cursor: pointer;
        }

        .info-select:hover {
            background: #097397;
            border-color: #097397;
            color: #fff;
        }

        .info-select:hover,
        .info-select:focus {
            /* background: #097397; */
        }

        .info-select option {
            background: #fff !important;
            color: #000 !important;
        }
    </style>
    <div id="introaction">

        <div id="introaction-core">

            <div class="action-message">

                <div class="action-text">

                    <h3 class="txt-sm">Welcome to FlashAlert Newswire, Messenger &amp; Monitor</h3>

                </div>

                <div class="action-teaser">

                    <p class="">Reach the Media with FA Newswire<br>

                        Reach the Public with FA Messenger<br>

                        Monitor your Coverage with YourNews</p>

                </div>

            </div>

        </div>

    </div>

    <div id="section-home">

        <div id="section-home-inner">

            <article class="section1 one_third">

                <div class="services-builder style1">

                    <div class="iconimage"><a
                            href="https://flashalert.projects-codingbrains.com/post-your-news/portland–salem–vancouver–longview/1"><i
                                class="fa fa-newspaper-o fa-2x"></i></a></div>

                    <div class="iconmain">

                        <h3>Newswire</h3>

                        <p>Provides information to the media for broadcast and web display. And each member organization has

                            its own web page where the public can see their closure status and latest news.</p>

                        <!-- <p class="iconurl">
                                <a class="themebutton2"
                                    href="https://flashalert.projects-codingbrains.com/post-your-news/portland–salem–vancouver–longview/1">MORE
                                    INFO</a>
                            </p> -->

                        {{-- <select class="form-select" aria-label="Default select example" style="font-size: 14px;"> --}}
                        {{-- <option value={{$regions->id}}>{{$regions->post_news_region}}</option> --}}
                        <div class="d-flex justify-content-center">
                            <select class="form-select info-select" aria-label="Default select example"
                                style="font-size: 14px;" onchange="redirectToNewsPage(this)">
                                <option selected disabled>MORE INFO</option>
                                @foreach ($postnewsregion as $regions)
                                    <option value="{{ $regions->id }}" data-region="{{ $regions->post_news_region }}">
                                        {{ $regions->post_news_region }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

            </article>

            <article class="section2 one_third">

                <div class="services-builder style1">

                    <div class="iconimage"><a href="{{ url('user-login') }}"><i class="fa fa-mobile fa-2x"></i></a></div>

                    <div class="iconmain">

                        <h3>Messenger</h3>

                        <p>Allows the public to subscribe to messages posted on Newswire, getting the information as emails

                            and &quot;push notifications&quot; through a free phone app (if the school/org offers Messenger

                            subscriptions).</p>

                        <p class="iconurl"><a class="themebutton2" href="{{ route('messengersub.login') }}">MORE INFO</a>
                        </p>

                    </div>

                </div>

            </article>

            <article class="section3 one_third last">

                <div class="services-builder style1" style="min-height:310px;">

                    <div class="iconimage"><a href="{{ url('monitor') }}"><i class="fa fa-laptop fa-2x"></i></a></div>

                    <div class="iconmain">

                        <h3>Monitor</h3>

                        <p>Included with premium accounts. It provides users with copies of your news as reported in

                            newspapers, TV, radio and social media; by TV market, state or nationwide.</p>

                        <p class="iconurl"><a class="themebutton2" href="{{ url('monitor') }}">MORE INFO</a></p>

                    </div>

                </div>

            </article>

            <div class="clearboth"></div>

        </div>

    </div>

    <div id="content">

        <div id="content-core">

            <div id="main">

                <div id="main-core">

                    <article id="post-17" class="post-17 page type-page status-publish hentry category-uncategorized">

                        <h2 class="has-text-align-center txt-sm">Celebrating 44 years of news distribution –

                            1979-2023</h2>

                        <p class="has-text-align-center cst-blu">
                            <a href="{{ route('messengersub.login') }}"
                                class="su-button su-button-style-3d mb-3 mb-md-0 width-sm9"
                                rel="noopener noreferrer">
                                <span> Messenger <em>Public</em> Login</span>
                            </a>
                            <a href="{{ route('backend.signin') }}"
                                class="su-button su-button-style-3d mb-2 mb-md-0 width-sm9"
                                rel="noopener noreferrer">
                                <span> Newswire <em> Client</em> Login</span>
                            </a>

                        </p>

                        <p class="has-text-align-center cst-green">
                            <a href="{{ route('blog') }}" class="su-button su-button-style-3d width-sm9 mb-3 mb-md-0"
                                style="color:#FFFFFF;background-color:#355E3B;border-color:#2b4c30;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px"
                                target="_blank" rel="noopener noreferrer"><span
                                    style="color:#FFFFFF;padding:0px 22px;font-size:17px;line-height:34px;border-color:#728f76;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;text-shadow:none;-moz-text-shadow:none;-webkit-text-shadow:none">

                                    Read about our latest enhancements</span></a>
                            <a href="https://zohosecurepay.com/checkout/8wkrz69-zhaj5jyg9zd0k/FlashAlert-Newswire"
                                class="su-button su-button-style-3d width-sm9"
                                style="color:#FFFFFF;background-color:#355E3B;border-color:#2b4c30;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px"
                                target="_blank" rel="noopener noreferrer"><span
                                    style="color:#FFFFFF;padding:0px 22px;font-size:17px;line-height:34px;border-color:#728f76;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;text-shadow:none;-moz-text-shadow:none;-webkit-text-shadow:none">

                                    Pay your invoice with a credit card</span></a>

                        <div class="table-responsive">

                            <table class="table table-borderless" style="border: none !important;">

                                <tbody>

                                    <tr>

                                        <td style="border: none;"></td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <!-- <div class="homepage-barcode">

                            
                        </div> -->

                        <div class="homepage-barcode align-items-center">

                            <figure class="aligncenter size-full text-center" style="width: 50%;"><img decoding="async" width="100%"
                                    height="auto" class=""
                                    src="{{ asset('front_assets/images/USAmapButtons2GotNews.jpeg') }}" alt srcset=""
                                    sizes="(max-width: 537px) 100vw, 537px">
                            </figure>

                            <figure class="aligncenter size-full text-center" style="width: 50%;"><img decoding="async" width="45%"
                                    height="auto" class=""
                                    src="{{ asset('front_assets/images/KeepCalm-1.png') }}" alt srcset=""
                                    sizes="(max-width: 537px) 100vw, 537px"
                                    style="border-radius: 12px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            </figure>
                        </div>
                    </p>

                    </article>

                </div><!-- #main-core -->

            </div><!-- #main -->

        </div>

    </div><!-- #content -->
    <script>
        function redirectToNewsPage(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            if (selectedOption.value !== "" && selectedOption.dataset.region) {
                const regionId = selectedOption.value;
                const regionName = selectedOption.dataset.region;
                const url = "{{ url('post-your-news') }}/" + regionName.toLowerCase() + "/" + regionId;
                window.location.href = url;
            }
        }
    </script>
@endsection
