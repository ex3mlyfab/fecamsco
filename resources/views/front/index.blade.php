<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FEMCAS @isset($header) | {{ $header }} @endif
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Health Insurance HMO claims reinbursement" name="keywords">
    <meta
        content="HMO,No 1 Health Management Organization in Nigeria, Offering affordable and responsive qualitative health Insurance for all Nigerians"
        name="description">

    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front') }}/lib/owlcarousel/front/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('front') }}/lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('front') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i> FEMCAS Secretariat, Federal
                        Medical Centre,
                        Abuja </small>
                    <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>(+234) 08100000000</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>info@femcas.com</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-linkedin-in fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i
                            class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <x-front.front-navbar></x-front.front-navbar>

        {{ $bg_header }}

    </div>


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-secondary p-3"
                            placeholder="Type search keyword">
                        <button class="btn btn-secondary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

    {{ $slot }}


    <x-front.footer></x-front.footer>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('front') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('front') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('front') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('front') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('front') }}/js/main.js"></script>
</body>

</html>
