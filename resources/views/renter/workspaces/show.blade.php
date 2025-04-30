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

    <!-- listing slider start -->
    <div class="listing-slider-section">
      <div class="listing-slider">
        <div class="item">
          <img src="{{ asset('assets/images/listing-slider-img-1.jpg') }}" alt="" class="w-100">
        </div>
        <div class="item">
          <img src="{{ asset('assets/images/listing-slider-img-2.jpg') }}" alt="" class="w-100">
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-n8">
            <ul class="list-inline text-right">
              <li class="list-inline-item mr-3">
                <span class="badge badge-success badge-pill">
                  <i class="fas fa-award mr-2"></i>Verified Space
                </span>
              </li>
              <li class="list-inline-item">
                <div class="">
                  <div class="btn-wishlist"></div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- listing slider close -->

    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <!-- listing nav start -->
          <div class="listing-nav sticky">
            <ul>
              <li><a class="page-scroll" href="#overview">Overview</a></li>
              <li><a class="page-scroll" href="#about">About</a></li>
              <li><a class="page-scroll" href="#amenities">Amenities</a></li>
              <li><a class="page-scroll" href="#video">Video</a></li>
              <li><a class="page-scroll" href="#review">Reviews</a></li>
              <li><a class="page-scroll" href="#location">Location</a></li>
              <li><a class="page-scroll" href="#similarspace">Similar Space</a></li>
            </ul>
          </div>
          <!-- listing nav close -->
        </div>
      </div>
    </div>

    <div class="pb-5 pt-5">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
            <div class="card mb-4" id="overview">
              <!-- listing detail head start -->
              <div class="card-header bg-white p-5">
                <h1 class="h2">{{ $workspace->title }}</h1>
                <p>
                  <span class="map-icon mr-2">
                    <i class="fas fa-map-marker-alt"></i>
                  </span>
                  {{ $workspace->location }}
                  <a href="#location" class="btn-link ml-2 page-scroll font-weight-bold">See Location</a>
                </p>
              </div>
              <div class="">
                <div class="row no-gutters">
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                    <div class="card-body">
                      <div class="meta-icon h3 text-primary mb-3">
                        <i class="fas fa-calendar-alt"></i>
                      </div>
                      <h5 class="meta-lable mb-1">{{ $workspace->min_term }} Year</h5>
                      <span class="meta-value">Minimum term</span>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                    <div class="card-body ml-1">
                      <div class="meta-icon h3 text-primary mb-3">
                        <i class="fas fa-vector-square"></i>
                      </div>
                      <h5 class="meta-lable mb-1">{{ $workspace->size }} SqFt</h5>
                      <span class="meta-value">Size</span>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                    <div class="card-body ml-1">
                      <div class="meta-icon h3 text-primary mb-3">
                        <i class="fas fa-users"></i>
                      </div>
                      <h5 class="meta-lable mb-1">{{ $workspace->people_capacity }}</h5>
                      <span class="meta-value">People</span>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="card-body ml-1">
                      <div class="meta-icon h3 text-primary mb-3">
                        <i class="fas fa-chair"></i>
                      </div>
                      <h5 class="meta-lable mb-1">{{ $workspace->space_type }}</h5>
                      <span class="meta-value">Space Type</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- listing detail head close -->
            </div>

            <!-- listing detail start -->
            <div class="card card-body mb-4 p-4" id="about">
              <h4 class="card-title">Description</h4>
              <p>{{ $workspace->description }}</p>
            </div>
            <!-- listing detail close -->

            <!-- listing detail start -->
            <div class="card card-body mb-4 amenities p-4" id="amenities">
              <h4 class="card-title">Amenities</h4>
              <ul class="list-unstyled">
                @foreach ($workspace->amenities as $amenity)
                  <li class="mb-2">
                    <i class="far fa-check-circle text-primary mr-2"></i>{{ $amenity->name }}
                  </li>
                @endforeach
              </ul>
            </div>
            <!-- listing detail close -->

            <!-- listing detail start -->
            <div class="card card-body mb-4 video p-4" id="video">
              <h4 class="listing-detail-card-title">Video</h4>
              <div class="video-testimonial-block">
                <div class="video">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ $workspace->video_url }}" allowfullscreen></iframe>
                  </div>
                </div>
                <a href="#" class="video-play"></a>
              </div>
            </div>
            <!-- listing detail close -->

            <!-- listing detail start -->
            <div class="card card-body mb-4 reviews p-4" id="review">
              <div class="d-lg-flex justify-content-between mb-4 align-items-center">
                <h3 class="mb-xl-0 pt-xl-2">{{ count($workspace->reviews) }} Review on office space listing</h3>
                <a href="#reviewform" class="btn btn-primary page-scroll">Write a Review</a>
              </div>

              @foreach ($workspace->reviews as $review)
                <div class="media mb-4">
                  <div class="media-img">
                    <img src="{{ asset('assets/images/avatar-1.jpg') }}" alt="" class="rounded-circle avatar-sm mr-3">
                  </div>
                  <div class="media-content">
                    <div class="mb-3">
                      <h5>{{ $review->author }}</h5>
                      <div class="review-content-rating small mb-2">
                        @for ($i = 0; $i < $review->rating; $i++)
                          <span class="fas fa-star text-warning"></span>
                        @endfor
                      </div>
                    </div>
                    <h6 class="mb-1">{{ $review->title }}</h6>
                    <p class="review-content-text mb-0">{{ $review->body }}</p>
                  </div>
                </div>
              @endforeach
            </div>
            <!-- listing detail close -->

            <!-- listing detail start -->
            <div class="card card-body mb-4 p-4" id="reviewform">
              <h3 class="">Write a Review</h3>
              <form class="form-row">
                <div class="form-group col-12">
                  <label for="reviewtitle">Review Title<span class="text-danger">*</span></label>
                  <input type="text" name="title" class="form-control" id="reviewtitle" placeholder="Write Review Title" required>
                </div>
                <div class="form-group col-6">
                  <label for="reviewname">Name<span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control" id="reviewname" placeholder="John Deo" required>
                </div>
                <div class="form-group col-6">
                  <label for="reviewemail">Email<span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control" id="reviewemail" placeholder="Enter email" required>
                </div>
                <div class="form-group col-12">
                  <label for="reviewdescription">Review Description</label>
                  <textarea class="form-control" id="reviewdescription" rows="3"></textarea>
                </div>
                <div class="form-group mb-0 col-12 d-flex align-items-center justify-content-between">
                  <button type="submit" class="btn btn-primary">Submit Review</button>
                  <small class="require-text">* Required Filed</small>
                </div>
              </form>
            </div>
            <!-- listing detail close -->
          </div>

          <!-- Sidebar -->
          <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
            <div class="listing-sidebar">
              <!-- listing widget start -->
              <div class="card bg-light mb-4">
                <div class="card-body">
                  <span class="mb-0 h3 font-weight-bold">${{ $workspace->price_per_month }}</span>
                  <span class="text-dark font-weight-bold">/Month</span>
                </div>
              </div>
              <!-- listing widget close -->
              <!-- Contact a Property Owner -->
              <div class="card mb-4">
                <h4 class="card-header bg-white mb-0">Contact a Property Owner</h4>
                <div class="card-body">
                  <div class="media mb-4 align-items-center">
                    <div class="media-img mr-3">
                      <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="" class="avatar-md rounded-circle border-primary border">
                    </div>
                    <h5 class="profile-name">{{ $workspace->owner_name }}</h5>
                  </div>
                  <a href="JavaScript:void(0);" class="btn btn-outline-primary btn-block">
                    <span data-replace="555-555-1212">{{ $workspace->owner_phone }}</span></a>
                </div>
              </div>
              <!-- listing widget close -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Similar Spaces Section -->
    <div class="pb-5 pt-5" id="similarspace">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
            <h2>Discover similar spaces you’ll love.</h2>
          </div>

          @foreach ($similar_workspaces as $workspace)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card mb-4 mb-lg-0">
                <div class="card-img position-relative">
                  <a href="{{ route('renter.workspaces.show', $workspace->id) }}">
                    <img src="{{ asset('assets/images/listing-img-1.jpg') }}" alt="" class="img-fluid rounded-top w-100">
                    <div class="card-overlay-badge badge badge-primary">Featured</div>
                  </a>
                  <a href="{{ route('renter.workspaces.show', $workspace->id) }}" class="badge badge-success card-overlay-category">{{ $workspace->space_type }}</a>
                </div>
                <div class="card-body">
                  <div class="mb-2">
                    <a href="{{ route('renter.workspaces.show', $workspace->id) }}">
                      <h3 class="h5 mb-1 text-truncate">{{ $workspace->title }}</h3>
                    </a>
                    <p class="font-14">{{ $workspace->location }}</p>
                  </div>
                  <div class="mb-3 font-12">
                    <span class="fas fa-star text-warning"></span>
                    <span class="fas fa-star text-warning"></span>
                    <span class="fas fa-star text-warning"></span>
                    <span class="fas fa-star text-warning"></span>
                    <span class="fas fa-star-half text-warning"></span>
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
            </div>
          @endforeach
        </div>
      </div>
    </div>

    @include('components.footer')
  </body>
</html>
