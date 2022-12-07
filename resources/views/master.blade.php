<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Veltrix - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        @stack('styles')
    </head>

    <body>

        <div id="wrapper">
            @include('_inc.topbar')
            @include('_inc.leftsidebar')
            <div class="content-page">
                @yield('content')
                @include('_inc.footer')
            </div>
        </div>

        @stack('scripts')

    </body>

</html>
