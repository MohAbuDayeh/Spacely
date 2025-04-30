<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="SpaceCity Dashboard" />
    <title>@yield('pageTitle', 'Dashboard Overview')</title>

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Libs CSS -->
   <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}" />

   <!-- Load Dropzone -->
   <script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>

   <!-- Load jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


   <!-- Load TinyMCE -->
   <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>

    <!-- Optional: Link to Dropzone CSS from CDN if needed -->
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-light">
    <div class="db-wrapper">
        <!-- Header Start -->
        <div class="db-header">
            <nav class="navbar navbar-expand-lg db-navbar fixed-top bg-white navbar-light shadow-sm">
                <div class="db-navbar-brand">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/spacely-logo.svg') }}" alt="" />
                    </a>
                </div>
                <div class="db-navbar-toggler order-3 ml-3 ml-lg-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbardbCollapse"
                        aria-controls="navbardbCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
        <!-- Header End -->

        <!-- Content Start -->
        <div class="db-content py-lg-15 py-11">
            <div class="container">
                @yield('content')
            </div>
        </div>
        <!-- Content End -->
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-raty-js/lib/jquery.raty.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/libs/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/libs/leaflet/dist/leaflet.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>

    @stack('scripts') <!-- This allows scripts to be added per page -->
</body>

</html>
