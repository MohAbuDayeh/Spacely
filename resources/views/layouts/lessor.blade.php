<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="SpaceCity Dashboard" />
    <title>@yield('title', 'Dashboard Overview')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Preload important resources -->
    <link rel="preload" href="{{ asset('assets/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" as="script">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

    <style>
        /* Add these styles to fix layout issues */
        body {
            overflow-x: hidden;
        }

        .db-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .db-content {
            flex: 1;
            padding-top: 70px; /* Adjust based on your header height */
        }

        .db-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        /* Ensure content doesn't hide behind fixed header */
        main {
            margin-top: 70px; /* Should match header height */
        }

        /* Fix for sidebar and content alignment */
        .row.no-gutters {
            margin-left: 0;
            margin-right: 0;
        }

        .row.no-gutters > [class*="col-"] {
            padding-left: 0;
            padding-right: 0;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-light">
    <div class="db-wrapper">
        <!-- Header Start -->
        <div class="db-header">
            <nav class="navbar navbar-expand-lg db-navbar fixed-top bg-white navbar-light shadow-sm">
                <div class="db-navbar-brand">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/spacely-logo.svg') }}" alt="Spacely Logo" width="120" height="40" />
                    </a>
                </div>
                <div class="db-navbar-toggler order-3 ml-3 ml-lg-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbardbCollapse"
                        aria-controls="navbardbCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <!-- Right Side Navigation -->
                <div class="d-flex align-items-center ml-auto">
                    <!-- User Profile Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none"
                           id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/images/profile.jpn.webp') }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="rounded-circle mr-2"
                                 width="40"
                                 height="40">
                            <span class="text-dark">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="userDropdown">
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('lessor.profile.show', auth()->id()) }}">
                                <i class="far fa-user mr-2"></i> Profile
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('lessor.dashboard') }}">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Header End -->

        <!-- Content Start -->
        <main class="db-content py-lg-4 py-3"> <!-- Changed padding values -->
            <div class="container-fluid"> <!-- Changed to container-fluid for full width -->
                @yield('content')
            </div>
        </main>
        <!-- Content End -->
    </div>

    <!-- Loading scripts efficiently -->
    <script>
        window.appConfig = {
            csrfToken: "{{ csrf_token() }}",
            baseUrl: "{{ url('/') }}",
            assetUrl: "{{ asset('') }}"
        };
    </script>

    <!-- Libs JS with defer -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jquery-raty-js/lib/jquery.raty.js') }}" defer></script>
    <script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/dataTables.net-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jquery.easing/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/slick-carousel/slick/slick.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/leaflet/dist/leaflet.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}" defer></script>

    @stack('scripts')

    <script>
        $(document).ready(function(){
            // Initialize Owl Carousel
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                responsive: {
                    0: { items: 1 },
                    768: { items: 1 },
                    1000: { items: 1 }
                }
            });

            // Hover effect for buttons
            $(".primary-btn, .secondary-btn").hover(
                function() {
                    $(this).css("background-color", "#81c408");
                    $(this).css("color", "#fff");
                },
                function() {
                    $(this).css("background-color", "");
                    $(this).css("color", "");
                }
            );

            // Initialize second carousel if exists
            if($('.owl-carousel1').length) {
                $('.owl-carousel1').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 2 },
                        1000: { items: 3 }
                    }
                });
            }
        });
    </script>
</body>

</html>
