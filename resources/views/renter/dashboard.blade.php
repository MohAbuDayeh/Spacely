@extends('layouts.app')

<!-- Custom Styles -->
<style>
    /* Hero Section */
    .hero-section {
        min-height: 600px;
        display: flex;
        align-items: center;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.5s ease;
    }

    .hero-section:hover .hero-bg {
        transform: scale(1.05);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Typography Improvements */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        line-height: 1.3;
        color: #2d3748;
    }

    p,
    .text-muted {
        line-height: 1.7;
        font-size: 1.05rem;
    }

    .lead {
        font-size: 1.2rem;
    }

    /* Card Styles to match workspaces/index.blade.php */
    .workspace-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .workspace-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .hover-zoom {
        transition: transform 0.5s ease;
    }

    .workspace-card:hover .hover-zoom {
        transform: scale(1.05);
    }

    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .hover-scale {
        transition: transform 0.2s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s ease;
        background: rgba(0, 0, 0, 0.5);
    }

    .card-img-top:hover .img-overlay {
        opacity: 1;
    }

    .bg-primary-soft {
        background-color: rgba(13, 110, 253, 0.1);
        padding: 0.35rem 0.75rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .stretched-link::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        content: "";
    }
</style>

@section('content')
    <!-- Hero Slider Section -->
    <section class="hero-section position-relative">
        <div class="hero-bg" style="background-image: url('{{ asset('assets/images/home1.png') }}');"></div>
        <div class="hero-overlay"></div>
        <div class="container position-relative z-index-1">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-12 text-center py-lg-18 py-10 px-3">
                    <h1 class="text-white font-weight-bold mb-3 display-4">The Best Offices to Work in Your City</h1>
                    <p class="lead text-white mb-4" style="font-size: 1.25rem; line-height: 1.6;">
                        Book from thousands of unique work and meeting spaces with flexible terms
                    </p>
                    <a href="{{ route('renter.workspaces.index') }}" class="btn btn-primary btn-lg px-5 py-3 hover-scale">
                        Explore Spaces
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- Space Showcase Section -->
    <section class="py-8 py-lg-14 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 text-center mb-6">
                    <h2 class="mb-3">Types of Office Space Available</h2>
                    <p class="lead text-muted" style="max-width: 700px; margin: 0 auto;">
                        Explore the different types of office spaces tailored for your business needs
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card border-0 h-100 hover-lift">
                        <div class="card-img-top overflow-hidden">
                            <img src="{{ asset('assets/images/type-space-1.jpg') }}" alt="Meeting space"
                                class="img-fluid w-100 hover-zoom" style="height: 240px; object-fit: cover;">
                            <div class="img-overlay bg-dark-50 d-flex align-items-center justify-content-center">
                                <h3 class="text-white mb-0">Meeting Space</h3>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <p class="mb-0">Perfect for client meetings, presentations, and team gatherings</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card border-0 h-100 hover-lift">
                        <div class="card-img-top overflow-hidden">
                            <img src="{{ asset('assets/images/type-space-2.jpg') }}" alt="Coworking space"
                                class="img-fluid w-100 hover-zoom" style="height: 240px; object-fit: cover;">
                            <div class="img-overlay bg-dark-50 d-flex align-items-center justify-content-center">
                                <h3 class="text-white mb-0">Coworking Space</h3>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <p class="mb-0">Flexible workspaces for individuals and small teams</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100 hover-lift">
                        <div class="card-img-top overflow-hidden">
                            <img src="{{ asset('assets/images/type-space-3.jpg') }}" alt="Private Office"
                                class="img-fluid w-100 hover-zoom" style="height: 240px; object-fit: cover;">
                            <div class="img-overlay bg-dark-50 d-flex align-items-center justify-content-center">
                                <h3 class="text-white mb-0">Private Office</h3>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <p class="mb-0">Dedicated offices for teams needing privacy and focus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Available Office Spaces Section -->
    <section class="py-8 py-lg-14 bg-light">
        <div class="container">
            <div class="row align-items-center mb-6">
                <div class="col-lg-8">
                    <h2 class="mb-2">Recommended Workspaces For You</h2>
                    <p class="lead text-muted mb-0">
                        Discover workspaces that match your preferences
                    </p>
                </div>
                <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                    <a href="{{ route('renter.workspaces.index') }}" class="btn btn-outline-primary hover-scale">
                        Browse All Spaces
                    </a>
                </div>
            </div>

            <div class="row">
                @foreach ($workspaces as $workspace)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card workspace-card h-100">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('renter.workspaces.show', $workspace->id) }}">
                                    @php
                                        $workspaceImages = json_decode($workspace->images, true);
                                        $imageUrl = isset($workspaceImages[0])
                                            ? asset('storage/' . $workspaceImages[0])
                                            : asset('assets/images/default-workspace.jpg');
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $workspace->title }}"
                                        class="img-fluid workspace-img w-100">

                                    @if ($workspace->is_featured)
                                        <span class="featured-badge">Featured</span>
                                    @endif

                                    <span class="workspace-badge badge bg-{{ $workspace->type_color }}">
                                        {{ $workspace->type_name }}
                                    </span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h3 class="h5 mb-2">
                                    <a href="{{ route('renter.workspaces.show', $workspace->id) }}" class="text-dark">
                                        {{ Str::limit($workspace->title, 30) }}
                                    </a>
                                </h3>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                    {{ Str::limit($workspace->location, 30) }}
                                </p>
                              <div class="mb-3">
                                    @php
                                        $avgRating = round($workspace->avgRating()) / 2; // round to nearest 0.5
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)

                                        @if ($i <= $avgRating)
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i - 0.5 == $avgRating)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-1 small">({{ $workspace->totalReviews() }} reviews)</span>
                                </div>
                                <div class="d-flex justify-content-between border-top pt-3">
                                    <div>
                                        <span class="d-block small text-muted">Price</span>
                                        @if ($workspace->price_per_hour)
                                            <span class="font-weight-bold">${{ $workspace->price_per_hour }}/hr</span>
                                        @elseif($workspace->price_per_day)
                                            <span class="font-weight-bold">${{ $workspace->price_per_day }}/day</span>
                                        @else
                                            <span class="font-weight-bold">${{ $workspace->price_per_month }}/mo</span>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="d-block small text-muted">Capacity</span>
                                        <span class="font-weight-bold">{{ $workspace->people_capacity }}</span>
                                    </div>
                                    <div>
                                        <span class="d-block small text-muted">Size</span>
                                        <span class="font-weight-bold">{{ $workspace->size }} sq.ft</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How it Works Section (Modified for logged in users) -->
    <section class="py-8 py-lg-14 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-6">
                    <span class="badge bg-primary-soft text-primary mb-3">YOUR NEXT STEPS</span>
                    <h2 class="mb-3">Make the Most of Spacely</h2>
                    <p class="lead text-muted">
                        As a Spacely member, here's how you can enhance your experience
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4 d-flex">
                    <div class="card border-0 shadow-sm w-100 hover-lift">
                        <div class="card-header bg-primary text-white py-3">
                            <h3 class="h5 mb-0 text-center">Book More Spaces</h3>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex mb-4 flex-grow-1">
                                <div class="bg-primary text-white rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <span class="font-weight-bold">1</span>
                                </div>
                                <div class="ms-4">
                                    <h4 class="h5 mb-2">Explore</h4>
                                    <p class="text-muted mb-0">
                                        Discover new workspaces tailored to your preferences
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex mb-4 flex-grow-1">
                                <div class="bg-primary text-white rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <span class="font-weight-bold">2</span>
                                </div>
                                <div class="ms-4">
                                    <h4 class="h5 mb-2">Book Instantly</h4>
                                    <p class="text-muted mb-0">
                                        Reserve your preferred space with just a few clicks
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex flex-grow-1">
                                <div class="bg-primary text-white rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <span class="font-weight-bold">3</span>
                                </div>
                                <div class="ms-4">
                                    <h4 class="h5 mb-2">Enjoy</h4>
                                    <p class="text-muted mb-0">
                                        Experience seamless access to your booked workspace
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4 d-flex">
                    <div class="card border-0 shadow-sm w-100 hover-lift">
                        <div class="card-header bg-success text-white py-3">
                            <h3 class="h5 mb-0 text-center">Manage Bookings</h3>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex mb-4 flex-grow-1">
                                <div class="bg-success text-white rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <span class="font-weight-bold">1</span>
                                </div>
                                <div class="ms-4">
                                    <h4 class="h5 mb-2">View</h4>
                                    <p class="text-muted mb-0">
                                        Check your upcoming and past reservations
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex mb-4 flex-grow-1">
                                <div class="bg-success text-white rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <span class="font-weight-bold">2</span>
                                </div>
                                <div class="ms-4">
                                    <h4 class="h5 mb-2">Modify</h4>
                                    <p class="text-muted mb-0">
                                        Adjust your bookings as needed
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex flex-grow-1">
                                <div class="bg-success text-white rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <span class="font-weight-bold">3</span>
                                </div>
                                <div class="ms-4">
                                    <h4 class="h5 mb-2">Review</h4>
                                    <p class="text-muted mb-0">
                                        Share your experience with the community
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-12 text-center">
                    <a href="{{ route('renter.workspaces.index') }}" class="btn btn-primary px-5 py-3 hover-scale">
                        Continue Exploring
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
