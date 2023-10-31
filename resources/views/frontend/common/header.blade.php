<style>
    /* Style the active menu item */
    .active1 {
        background-color: #dbdbdb;
    }

    .active1 a {
        color: #4498e7 !important;
    }

    .activedropmenu a span {
        color: #4498e7 !important;
    }

    .collapse:not(.show) {
        display: inherit;
    }

    #header-responsive-inner {
        height: 0;
        overflow: hidden;
        transition: height 0.3s ease;
    }

    .collapse.in {
        height: auto;
        transition: max-height 0.5s ease-in-out;
    }

    #header-responsive-inner.collapse {
        transition: max-height 0.5s ease-in-out;
    }

    a {
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .nav-collapse {
        -webkit-transform: translate3d(0, 0, 0);
    }

    .nav-collapse.collapse {
        -webkit-transition: height 0.35s ease;
        -moz-transition: height 0.35s ease;
        -ms-transition: height 0.35s ease;
        -o-transition: height 0.35s ease;
        transition: height 0.35s ease;
    }
    .sub-menu li a{
        font-weight: 600 !important;
    }
</style>
<header>

    <div id="site-header">

        <div id="pre-header">

            <div class="">

                <div id="pre-header-core" class="main-navigation">

                </div>

            </div>

        </div>

        <!-- #pre-header -->

        <div id="header">

            <div id="header-core">

                <div id="logo">

                    <a href="{{ url('/') }}" class="custom-logo-link img-fluid" rel="home" aria-current="page"><img width="860" height="100" src="{{ asset('front_assets/images/HeaderImagewithLogo.png') }}" class="custom-logo" alt="FlashAlert Newswire &amp; Messenger" decoding="async" srcset="{{ asset('front_assets/images/HeaderImagewithLogo.png 860w, images/HeaderImagewithLogo-300x35.png 300w, images/HeaderImagewithLogo-768x89.png 768w') }}" sizes="(max-width: 860px) 100vw, 860px"></a>

                </div>

                <div id="header-links" class="main-navigation">

                    <div id="header-links-inner" class="header-links cst-head">

                        <ul id="menu-primary" class="menu">

                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  {{ Route::currentRouteName() === 'regions' ? 'activedropmenu' : '' }}">
                                <a href="javascript:void(0)">
                                    <span>
                                        <span id="content1">View Local</span>
                                        <span id="content2">News</span>
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                        <i>Choose a city below to view or subscribe to news from local organizations</i>
                                    </li>
                                    @foreach ($data['region'] as $key => $headerData)
                                    <li class="{{ Route::currentRouteName() === 'regions' && Request::is('region/' . strtolower(explode('/', $headerData['Description'])[0])) ? 'active1' : '' }}">
                                        <a class="dropdown-item" href="{{ URL('regions/' . strtolower(explode('/', $headerData['Description'])[0])) }}">
                                            {{ str_replace('/', '-', $headerData['Description']) }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page {{ Route::currentRouteName() === 'userlogin' ? 'activedropmenu' : '' }}">
                                <a href="{{ route('messengersub.login') }}"><span><span id="content1">Create / Manage
                                            Your</span>
                                        <span id="content2">Messenger Subscript</span></span></a>
                            </li>

                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children {{ Route::currentRouteName() === 'postnewsregions' ? 'activedropmenu' : '' }}">

                                <a href="javascript:void(0)"><span><span id="content1">Info for Clients, </span><span id="content2">Post Your News</span></span></a>

                                <ul class="sub-menu">

                                    <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="{{ route('backend.signin') }}"><b>Log in to your org’s account

                                                here</b></a></li>

                                    <li id="menu-item-214" class="menu-item menu-item-type-custom menu-item-object-custom"><i>Click below
                                            to learn about FlashAlert in your

                                            region:</i></li>

                                    @foreach ($data['postnewsregion'] as $key => $posts)
                                    <?php session(['postnews_id_' . $key => $posts->id]); ?>

                                    <li class="{{ Route::currentRouteName() === 'postnewsregions' && Request::is('post-your-news/' . strtolower($posts->post_news_region) . '/' . $posts->id) ? 'active1' : '' }}">
                                        <a class="dropdown-item" href="{{ url('post-your-news/' . strtolower($posts->post_news_region) . '/' . $posts->id) }}">

                                            {{ $posts->post_news_region }}</a>
                                    </li>
                                    @endforeach

                                </ul>

                            </li>

                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children {{ Route::currentRouteName() === 'newsmedia' ? 'activedropmenu' : '' }}">

                                <a href="{{ url('for-news-media') }}"><span><span id="content1">For News</span><span id="content2">

                                            Media</span></span></a>

                                <ul class="sub-menu">

                                    <li id="menu-item-294" class="menu-item menu-item-type-custom menu-item-object-custom"><i>Newsrooms can
                                            see regional news or
                                            learn more

                                            about FlashAlert</i></a></li>

                                </ul>

                            </li>
                            <!-- tutorials tab -->
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">

                                <a href="{{ url('for-news-media') }}"><span><span id="content1">TUTORIALS</span><span id="content2" style="text-transform: capitalize;">(Video)</span></span></a>

                                <ul class="sub-menu">

                                    <li id="menu-item-294" class="menu-item menu-item-type-custom menu-item-object-custom"><a><i class="fa fa-video-camera mx-1" aria-hidden="true"></i> Video </a></li>
                                    <li id="menu-item-294" class="menu-item menu-item-type-custom menu-item-object-custom"><a><i class="fa fa-video-camera mx-1" aria-hidden="true"></i> Video </a></li>
                                    <li id="menu-item-294" class="menu-item menu-item-type-custom menu-item-object-custom"><a><i class="fa fa-video-camera mx-1" aria-hidden="true"></i> Video </a></li>

                                </ul>

                            </li>
                            <!-- tutorials tab end -->
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="javascript:void(0)"><span><span id="content1">Sponsored</span><span id="content2">

                                            Content</span></span></a></li>

                            <li class="menu-item menu-item-type-post_type menu-item-object-page {{ Route::currentRouteName() === 'about' ? 'activedropmenu' : '' }}">
                                <a href="{{ route('about') }}"><span><span id="content1">About</span><span id="content12"> FlashAlert</span></span></a>
                            </li>

                        </ul>

                    </div>

                </div>

                <!-- #header-links .main-navigation -->

                <div id="header-nav"><a class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>

                </div>

            </div>

        </div>

        <!-- #header -->

        <div id="header-responsive">

            <div id="header-responsive-inner" class="responsive-links nav-collapse collapse">

                <ul id="menu-primary-1" class>

                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="javascript:void(0)"><span><span id="content1">View Local</span><span id="content2">News</span></span></a>

                        <ul class="sub-menu">

                            <li class="menu-item menu-item-type-custom menu-item-object-custom">

                                <a href="javascript:void(0)">&#45; <i>Choose a city below to view or subscribe to news
                                        from local

                                        organizations</i></a>
                            </li>

                            @foreach ($data['region'] as $key => $headerData)
                            <li><a class="dropdown-item" href="{{ URL('region/' . strtolower(explode('/', $headerData['Description'])[0])) }}">
                                    {{ str_replace('/', '-', $headerData['Description']) }}</a></li>
                            @endforeach

                        </ul>

                    </li>

                    <li id="" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="{{ route('messengersub.login') }}"><span><span id="content1">Create / Manage
                                    Your</span> <span id="content2">Messenger Subscript</span></span></a>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="javascript:void(0)"><span><span id="content1">Info for Clients, </span> <span id="content2">Post Your News</span></span></a>

                        <ul class="sub-menu">

                            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                <a href="{{ route('backend.signin') }}">&#45; <b>Log in to your org’s account
                                        here</b></a>
                            </li>

                            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                <a href="javascript:void(0)">&#45; <i>Click below to learn about FlashAlert in your

                                        region:</i></a>
                            </li>

                            @foreach ($data['postnewsregion'] as $key => $posts)
                            <?php session(['postnews_id_' . $key => $posts->id]); ?>

                            <li><a class="dropdown-item" href="{{ url('post-your-news/' . strtolower(str_replace(' ', '', $posts->post_news_region)) . '/' . $posts->id) }}">

                                    {{ $posts->post_news_region }}</a></li>
                            @endforeach

                    </li>
                </ul>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="for-news-media"><span><span id="content1">For News</span><span id="content2">Media</span></span></a>
                    <ul class="sub-menu">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/for-news-media/">&#45; <i>Newsrooms can see regional news or learn more
                                    about FlashAlert</i></a></li>
                    </ul>
                </li>


                <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="javascript:void(0)"><span><span id="content1">Sponsored</span><span id="content2">

                                Content</span></span></a>
                </li>

                <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="{{ route('about') }}"><span><span id="content1">About</span><span id="content12">

                                FlashAlert<span></span></span></span></a>
                </li>

            </div>

        </div>

    </div>

</header>
<script>
    jQuery(document).ready(function() {
        var isCollapsed = true;
        jQuery(".dropdown-menu").hide();

        jQuery('.btn-navbar').click(function() {
            jQuery('#header-responsive-inner').toggleClass('in', !isCollapsed).slideDown();

            if (!isCollapsed) {
                jQuery('#header-responsive-inner').css('height', '0');
            } else {
                jQuery('#header-responsive-inner').css('height', 'auto ');
            }

            jQuery('.btn-navbar').removeClass('collapse');
            isCollapsed = !isCollapsed;
        });

        jQuery("#loginDropdown").click(function() {
            jQuery(".dropdown-menu").toggle();
        });
        jQuery(document).on("click", function(event) {
            var logdropdown = jQuery(".dropdown-menu");
            var toggleButton = jQuery("#loginDropdown");

            // Check if the clicked element is not the dropdown or the toggle button
            if (!logdropdown.is(event.target) && !toggleButton.is(event.target) && logdropdown.has(event.target).length === 0) {
                logdropdown.hide(); // Close the dropdown
            }
        });
    });
</script>
<!-- header -->