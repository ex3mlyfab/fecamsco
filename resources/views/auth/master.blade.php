<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description"
        content="Femcas Is a Multipurpose corporative society for staff of Federal Medical Centre Abuja. For your Loans and Other financial Services contact us">
    <meta name="keywords"
        content="corporative Society, loans, contribution, federal medical centre, abuja , electronic loan">
    <meta name="author" content="Abdulkadir Olatunji for Fabtech limited">
        <meta http-equiv="refresh" content="{{ config('session.lifetime')*60 }}" >
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <title>@yield('title')</title>
        <!-- Google font-->
        @includeIf('admin.authentication.partials.css')
    </head>
    <body>
        <!-- Loader starts-->
        <div class="loader-wrapper">
            <div class="theme-loader">
                <div class="loader-p"></div>
            </div>
        </div>
        <!-- Loader ends-->
        <!-- error page start //-->
        @yield('content')
        <!-- error page end //-->
        <!-- latest jquery-->
        @includeIf('admin.authentication.partials.js')
    </body>
</html>



