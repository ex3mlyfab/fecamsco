<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Femcas Is a Multipurpose corporative society for staff of Federal Medical Centre Abuja. For your Loans and Other financial Services contact us">
    <meta name="keywords"
        content="corporative Society, loans, contribution, federal medical centre, abuja , electronic loan">
    <meta name="author" content="Abdulkadir Olatunji for Fabtech limited">
    <meta http-equiv="refresh" content="{{ config('session.lifetime')*60 }}" >
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     @livewireStyles
    @livewireScripts
    <title>@yield('title')|Femcas</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->

    @includeIf('layouts.modern-layout.partials.css')

</head>

<body>
    {{-- <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader"></div>
    </div>
    <!-- Loader ends--> --}}
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper modern-sidebar" id="pageWrapper">
        <!-- Page Header Start-->
        @includeIf('layouts.modern-layout.partials.header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper modern-sidebar">
            <!-- Page Sidebar Start-->
            @includeIf('layouts.modern-layout.partials.admin-sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright {{ date('Y') }}-{{ date('y', strtotime('+1 year')) }} ©
                                fabtech All rights reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="pull-right mb-0">Hand crafted & made with <i
                                    class="fa fa-heart font-secondary"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->

    <script type="text/javascript">
        // localStorage.clear();
        var div = document.querySelector("div.page-wrapper")
        var b = div.classList.contains('compact-sidebar'); // true;
        if (b) {
            div.classList.remove("compact-sidebar");
        }
        localStorage.setItem('page-wrapper', 'page-wrapper compact-wrapper modern-sidebar');
        localStorage.setItem('page-body-wrapper', 'sidebar-icon');
    </script>

    @includeIf('layouts.modern-layout.partials.js')
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    @if (session()->has('message'))
    <script>
            'use strict';
        var notify = $.notify('<i class="fa fa-bell-o"></i><strong>{{session('message')}}</strong>', {
            type: 'theme',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: true,
            timer: 300
        });

        // setTimeout(function() {
        //     notify.update('message', '<i class="fa fa-bell-o"></i><strong>Loading</strong> Inner Data.');
        // }, 1000);
    </script>
    @endif


</body>

</html>
