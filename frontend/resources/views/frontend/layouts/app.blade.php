<!DOCTYPE html>
<html lang="{{ 'en_GB' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title', 'Laravel Micro-services Example')</title>
        <meta name="description" content="@yield('meta_description', 'Laravel Micro-services Example')">
        <meta name="author" content="@yield('meta_author', 'Apex Creation')">
        @yield('meta')

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

        <!-- Custom CSS -->
        <style>
            .navbar-brand {
                margin-left: 1.5em;
            }

            #app ul.navbar-nav {
                width: 50%;
                margin: auto auto;
            }

            .app-footer {
                width: 50%;
                margin: 2em auto auto;
            }
        </style>

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        @stack('after-styles')
    </head>
    <body>

        <div id="app">
            @include('frontend.includes.nav')

            <div class="container">
                @yield('content')
            </div><!-- container -->
        </div><!-- #app -->

        @include('frontend.includes.footer')

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        @stack('before-scripts')
        @stack('after-scripts')
    </body>
</html>
