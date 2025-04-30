<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

    <title>Spacely</title>
  </head>

  <body>
     <div class="">
       @include('components.header')  <!-- Include Header -->
     </div>

    <!-- pageheader start -->
    <div class="pageheader" style="background: url('{{ asset('assets/images/pageheader-img.jpg') }}'); background-repeat: no-repeat; background-size: cover;">
      <div class="container">
        <div class="row">
          <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="pageheader-caption">
              <h1 class="pageheader-caption-title">Layout Grid & List</h1>
              <p class="pageheader-caption-text">
                Change your layout in grid and list view example using bootstrap
                4. Design elements using Bootstrap, javascript, css, and html.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- pageheader close -->

    <div class="container">
      <div class="row">
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
          <!-- breadcrumb start -->
          <div class="custom-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Layout Grid & List</li>
              </ol>
            </nav>
          </div>
          <!-- breadcrumb close -->
        </div>
      </div>
    </div>

    <div class="pb-5 pt-5">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="row">
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mb-4">
                <!-- page switcher start -->
                {{-- <div class="page-switcher">
                  <a href="{{ route('renter.workspaces.index') }}"><i class="fas fa-list icon-shape border p-3 rounded"></i></a>
                  <a href="{{ route('renter.workspaces.index') }}" class="active"><i class="fas fa-th icon-shape border p-3 rounded bg-primary text-white"></i></a>
                  <a href="{{ route('renter.workspaces.index') }}"><i class="fas fa-map-marker-alt icon-shape border p-3 rounded"></i></a>
                </div> --}}
                <!-- page switcher close -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-4">
                <!-- select form start -->
                <select class="select2 form-control custom-select" id="search-hide">
                  <option selected>Default</option>
                  <option value="1">Most Viewed</option>
                  <option value="2">Newest Listing</option>
                  <option value="3">Older Listing</option>
                </select>
                <!-- select form close -->
              </div>
            </div>

            <div class="row">
              @foreach ($workspaces as $workspace) <!-- Assuming you have a $workspaces array passed to the view -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                  <!-- listing block start -->
                  <div class="card mb-3 mb-lg-4">
                    <div class="card-img position-relative">
                      <a href="{{ route('renter.workspaces.show', $workspace->id) }}">
                        <img src="{{ asset('assets/images/' . $workspace->image) }}" alt="Workspace Image" class="img-fluid rounded-top w-100" />
                      </a>
                      <a href="{{ route('renter.workspaces.show', $workspace->id) }}" class="badge badge-success card-overlay-category">
                        {{ $workspace->space_type }}
                      </a>
                    </div>
                    <div class="card-body">
                      <div class="mb-2">
                        <a href="{{ route('renter.workspaces.show', $workspace->id) }}">
                          <h3 class="h5 mb-1 text-truncate">{{ $workspace->title }}</h3>
                        </a>
                        <p class="font-14">{{ $workspace->location }}</p>
                      </div>
                      <div class="mb-3 font-12">
                        @for ($i = 0; $i < 5; $i++)
                          <span class="fas fa-star {{ $i < $workspace->rating ? 'text-warning' : 'text-light' }}"></span>
                        @endfor
                        <a href="{{ route('renter.workspaces.show', $workspace->id) }}" class="badge badge-success ml-1">{{ $workspace->rating }}</a>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="font-weight-medium">
                          <span class="font-12">Monthly</span><br>
                          <span class="font-14 text-dark">${{ $workspace->price_per_month }}</span>
                        </div>
                        <div class="font-weight-medium">
                          <span class="font-12">People</span><br>
                          <span class="font-14 text-dark">{{ $workspace->people_capacity }}</span>
                        </div>
                        <div class="font-weight-medium">
                          <span class="font-12">Sq.Ft</span><br>
                          <span class="font-14 text-dark">{{ $workspace->size }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- listing block close -->
                </div>
              @endforeach
            </div>
          </div>

          <!-- Sidebar with Filters -->
          <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-body">
                <h3 class="mb-0 h4"><span class="p text-primary mr-2"><i class="fas fa-sliders-h"></i></span> Filter</h3>
              </div>

              <!-- Price Filter -->
              <div class="card-body border-top">
                <a class="d-block h5 mb-0" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Price <i class="fas fa-angle-down ml-2 float-right"></i>
                </a>
                <div class="collapse show" id="collapseExample">
                  <div class="py-3">
                    <!-- Add filters here -->
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck1" />
                      <label class="custom-control-label" for="customCheck1">$0 - $100</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck2" />
                      <label class="custom-control-label" for="customCheck2">$100 - $200</label>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Search Button -->
              <div class="card-body border-top">
                <a href="#" class="btn btn-primary btn-block">Search</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Include Footer -->
    @include('components.footer')

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

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
  </body>
</html>
