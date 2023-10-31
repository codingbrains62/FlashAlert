<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Welcome to FlashAlert Newswire - Messenger - Monitor - FlashAlert Newswire &amp; Messenger</title>
<link href="{{ asset('front_assets/images/FlashAlert-Icon.png') }}" rel="icon">
<link href="{{ url('front_assets/images/FlashAlert-apple-touch.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{url('/css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;400&family=Poppins:wght@100;200;300;400;600;700&family=Raleway:wght@200;300;500&family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" id="wp-block-library-css" href="{{asset('front_assets/css/style.min.css')}}" type="text/css" media="all">
<link rel="stylesheet"  href="{{asset('front_assets/css/style.css')}}" type="text/css" media="all">
<link rel="stylesheet"  href="//fonts.googleapis.com/css?family=Raleway%3A300%2C400%2C600%2C700%7COpen+Sans%3A300%2C400%2C600%2C700&amp;subset=latin%2Clatin-ext" type="text/css" media="all">
<link rel="stylesheet"  href="{{asset('front_assets/css/bootstrap.min.css')}}" type="text/css" media="all">
<link rel="stylesheet"  href="{{asset('front_assets/css/font-awesome.min.css')}}" type="text/css" media="all">
<link rel="stylesheet"  href="{{asset('front_assets/css/style-shortcodes.css')}}" type="text/css" media="all">
<link rel="stylesheet"  href="{{asset('front_assets/css/style.css')}}" type="text/css" media="all">
<link rel="stylesheet"  href="{{asset('front_assets/css/all.css')}}" type="text/css" media="all" crossorigin="anonymous">
<link rel="stylesheet"  href="{{asset('front_assets/css/style-responsive.css')}}" type="text/css" media="all">
<link rel="stylesheet"  href="{{asset('front_assets/css/v4-shims.css')}}" type="text/css" media="all" crossorigin="anonymous">
<link rel="stylesheet" id="su-shortcodes-css" href="{{asset('front_assets/css/shortcodes.css')}}" type="text/css" media="all">
<script type="text/javascript" src="{{asset('front_assets/js/jquery.min.js')}}" id="jquery-core-js"></script>
<style>#body-core {background: #FFFFFF;}#introaction-core h1, #introaction-core h2, #introaction-core h3, #introaction-core h4, #introaction-core h5, #introaction-core h6,#outroaction-core h1, #outroaction-core h2, #outroaction-core h3, #outroaction-core h4, #outroaction-core h5, #outroaction-core h6,#content h1, #content h2, #content h3, #content h4, #content h5, #content h6 {color: #FFFFFF;}body,button,input,select,textarea,.action-teaser {color: #000000;}#content a {color: #FFFFFF;}#content a:hover {color: #FFFFFF;}</style><link rel="icon" href="images/cropped-FlashAlert-app-logo-32x32.png" sizes="32x32">
<link rel="stylesheet"  href="{{asset('front_assets/css/my.css')}}" type="text/css" media="all">		
</head>
<body class="home page-template-default page page-id-17 wp-custom-logo layout-sidebar-none layout-responsive layout-wide pre-header-style2 header-style1">
<div id="body-core" class="hfeed site">
@php 
$data=Helper::MenuHeaderData();
@endphp
@include('frontend.common.header')
@yield('content')
@include('frontend.common.footer')
</div><!-- #body-core -->
<script type="text/javascript" src="{{asset('front_assets/js/bootstrap.js')}}" id="thinkup-bootstrap-js"></script>
<script type="text/javascript" src="{{asset('front_assets/js/main-frontend.js')}}" id="thinkup-frontend-js"></script>
</body>
</html>