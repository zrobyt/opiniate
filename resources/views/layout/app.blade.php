<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name='google' content='notranslate'>
    <meta name='keywords' content='Opiniate, Opinion Polls'>
    <meta name='author' content='Sevon Inkor Technologies Private Ltd'>
    <meta name='copyright' content='reserved'>
    <meta http-equiv='Cache-Control' content='no-cache, no-store, must-revalidate' />

    <meta property="og:type" content="website" />
    <meta content="@yield('desc')" name="description" />
    <meta property="og:site_name" content="www.opiniate.in" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:image" itemprop="image" content="@yield('img')" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:description" content="@yield('desc')" />
    <meta property="og:url" content="@yield('url')" />

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Popper.js -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- SignIn with Google -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- Google Adsense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7783879415436265" crossorigin="anonymous"></script>

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        a:hover {
            color: #198754 !important;
        }

        @media (orientation: portrait) {
            :root {
                font-size: 0.85rem;
            }

            .pollThumb {
                height: 110px;
            }

            #signin {
                margin-top: -0.25rem;
                margin-right: -0.15rem !important;
            }

            #user[status="in"] {
                margin-top: -0.22rem;
                margin-right: -0.1rem !important;
            }
        }

        @media (orientation: landscape) {
            .pollThumb {
                height: 135px;
            }
        }

        #user {
            font-family: "Google Sans", arial, sans-serif;
            font-size: 13px;
            letter-spacing: 0.25px;
            padding: 5px 14.5px !important;
            color: #3c4043;
            display: inline-block;
            width: 5.5rem;
        }
    </style>
    <script>
        function iRetry() {
            this.src = '/default.png';
            this.onerror = null;
        }
    </script>

</head>

<body class="antialiased m-0 p-0 bg-light">

    <div class='p-3 bg-white border-bottom position-sticky mb-4 fs-5 fixed-top'>

        <a class='' href="/">
            <div class='d-inline-block align-middle float-start ms-lg-3 me-1' style='height:2.5rem;margin-top:-0.3rem;'>
                <img class='h-100' src="/opiniate.png" alt="">
            </div>
            <div class='d-none d-lg-inline-block small p-1 ps-3 pe-3 rounded-pill bg-light'>
                Opiniate
            </div>
        </a>
        <span class='ms-2 small'><span class='d-none d-lg-inline-block'>-</span><small class='text-muted'> @yield('title')</small> </span>

        <a href="{{ (Route::currentRouteName()=='menu')?url()->previous():'/menu'}}">
            <div class='float-end d-inline-block ms-3 ms-lg-0' style='height:1.5rem;'>
                <img id='menu' class='h-100 w-100' src="/menu.png" alt="" style='opacity:{{ (Route::currentRouteName()=="menu")?"0.35":"1" }};'>
            </div>
        </a>

        <div id="signin" class='float-end me-3 align-top' style='display:{{ (session()->has("creden"))?"none":"inline-block" }};'></div>
        @csrf

        <div id="user" status='{{ (session()->has("creden"))?"in":"" }}' class='bg-white float-end me-3 align-top rounded-pill text-success fs-7 text-truncate text-center' style='cursor:pointer;display:{{ (session()->has("creden"))?"inline-block":"none" }};'>
            <a href="/profile">
                {{ (session()->has("name"))?session()->get("name"):"" }}
            </a>
        </div>

    </div>

    <div class='w-100'>

        <div class='d-inline-block w-100 p-2 p-lg-3'>
            @yield('content')
        </div>
        <!--<div class='d-inline-block bg-white border border-dark col-lg-2 col-12 position-sticky  align-top' style='height:77vh;top:6rem;'>
            <div class='d-inline-block text-center'>Ads</div>
        </div>-->
    </div>


</body>
<script src="{{ asset('js/s1.js') }}"></script>
<script>
    window.onload = function() {

        google.accounts.id.initialize({
            client_id: "776112960557-fdg21h705qrqc199h9lp4ff1qab69nva.apps.googleusercontent.com",
            callback: onsig
        });

        google.accounts.id.renderButton(
            document.getElementById("signin"), {
                type: "standard",
                shape: "pill",
                theme: "outline",
                text: "signin",
                size: "medium",
                logo_alignment: "center",
                width: "100",
            }
        );

        <?php
        if (!(session()->has('name'))) {
            echo ("google.accounts.id.prompt();");
        }
        ?>

    }
</script>

</html>