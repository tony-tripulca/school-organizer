<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="language" content="English">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="title" content="School Organizer">
        <meta name="description" content="A simple school organizer for my little sister">
        <meta name="keywords" content="">

        <meta property="og:type" content="website">
        <meta property="og:url" content="http://schoorg.nadescrib.com">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="School Organizer">
        <meta property="og:title" content="School Organizer">
        <meta property="og:description" content="A simple school organizer for my little sister">
        <meta property="og:image" content="https://lh3.googleusercontent.com/5EfQBHDb47tchiART6U6yk3yYS9qBYr6VUssB5wHE1AgavqV5E2SSuzyiNkc7UgVng?cache=08292020_00">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@titanhealthfitness">
        <meta name="twitter:creator" content="@titanhealthfitness">
        <meta name="twitter:title" content="School Organizer">
        <meta name="twitter:description" content="A simple school organizer for my little sister">
        <meta name="twitter:image" content="https://lh3.googleusercontent.com/5EfQBHDb47tchiART6U6yk3yYS9qBYr6VUssB5wHE1AgavqV5E2SSuzyiNkc7UgVng?cache=08292020_00">
        <meta name="twitter:image:width" content="1200">
        <meta name="twitter:image:height" content="630">
        
        @auth
		    <meta name="user_id" content="{{ $current_user['id'] }}">
            <meta name="api_token" content="{{ $current_user['api_token'] }}">
            <meta name="csrf_token" content="{{ csrf_token() }}">
	    @endauth

        @yield('meta')

        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('icons/materialize-icons/iconfont/material-icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('icons/themify-icons/themify-icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/hamburgers/dist/hamburgers.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/toast/dist/jquery.toast.min.css') }}">

        @yield('plugin-styles')

        @if(config('app.env') == "production")
            <link rel="stylesheet" type="text/css" href="{{ asset('css/utilities.min.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/preloader.min.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/ajax-loader.min.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/main.min.css') }}">
        @else
            <link rel="stylesheet" type="text/css" href="{{ asset('css/utilities.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/preloader.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/ajax-loader.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/main.css') }}">
        @endif

        @yield('module-styles')

        <title>{{ $tab_title }}</title>
    </head>
    <body>
        <div class="preloader">
            <div class="spinner spinner-3"></div>
        </div>
        <div class="wrapper">
            <header>
                @yield('navigation')
            </header>
            <main>
                <div class="content-wrap">
                    @yield('content')
                </div>
            </main>
            <footer>
                @yield('footer')
            </footer>
        </div>
        
        @yield('manage-modal')
        @yield('create-modal')
        @yield('read-modal')
        @yield('update-modal')
        @yield('delete-modal')

        <script type="text/javascript">function url() { return "{{ url('/') }}"; }</script>
        <script type="text/javascript">function api() { return "{{ url('/') }}/api"; }</script>
        <script type="text/javascript">function asset() { return "{{ url('/') }}/application/public"; }</script>
        <script type="text/javascript" src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/toast/dist/jquery.toast.min.js') }}"></script>

        @yield('plugin-scripts')

        @if(config('app.env') == "production")
            <script type="text/javascript" src="{{ asset('js/admin/preloader.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/admin/main.min.js') }}"></script>
        @else
            <script type="text/javascript" src="{{ asset('js/admin/preloader.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/admin/main.js') }}"></script>
        @endif
        
        @yield('module-scripts')
    </body>
</html>
