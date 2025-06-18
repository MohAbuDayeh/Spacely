@extends('layouts.lessor')

@section('pageTitle', 'Workspace Details')

@section('content')
    <div class="row no-gutters db-main-container">
        <!-- Sidebar Section - Same as Dashboard -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 db-sidenav-container">
            <nav class="navbar navbar-expand-lg db-sidenav h-100">
                <div class="collapse navbar-collapse h-100 d-flex flex-column" id="navbardbCollapse">
                    <div class="db-sidebar-header py-4 px-3 text-center">
                        <img src="{{ asset('assets/images/spacely-logo.svg') }}" alt="Logo" class="img-fluid mb-3" width="120">
                        <h5 class="text-white mb-0">{{ Auth::user()->name }}</h5>
                        <small class="text-light">Lessor Dashboard</small>
                    </div>

                    <ul class="nav flex-column w-100 db-sidebar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.dashboard') ? 'active' : '' }}"
                                href="{{ route('lessor.dashboard') }}">
                                <i class="fas fa-fw fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.workspaces.index') ? 'active' : '' }}"
                                href="{{ route('lessor.workspaces.index') }}">
                                <i class="fas fa-fw fa-list mr-2"></i>Workspaces
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.request-quote') ? 'active' : '' }}"
                                href="{{ route('lessor.request-quotes') }}">
                                <i class="fas fa-fw fa-receipt mr-2"></i>Request Quote
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.reviews') ? 'active' : '' }}"
                                href="{{ route('lessor.reviews') }}">
                                <i class="fas fa-fw fa-star mr-2"></i>Reviews
                            </a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('lessor.bookings.index') ? 'active' : '' }}"
                                    href="{{ route('lessor.bookings.index') }}">
                                    <i class="fas fa-fw fa-calendar-check mr-2"></i>Bookings
                                </a>
                            </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.invoices.index') ? 'active' : '' }}"
                                href="{{ route('lessor.invoices.index') }}">
                                <i class="fas fa-fw fa-file-invoice mr-2"></i>Invoices
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.profile') ? 'active' : '' }}"
                               href="{{ route('lessor.profile.show', ['id' => auth()->id()]) }}">
                                <i class="fas fa-fw fa-user-circle mr-2"></i>Profile
                            </a>
                        </li>
                    </ul>

                    <div class="mt-auto db-sidebar-footer p-3">
                        <form action="{{ route('logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-block">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content Section -->
        <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 db-main-content">
            <div class="container-fluid py-4">
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="h4 font-weight-bold text-dark mb-1">Workspace Details</h2>
                                <p class="mb-0 text-muted">View and manage your workspace details</p>
                            </div>
                            <div>
                                <a href="{{ route('lessor.workspaces.edit', $workspace->id) }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <a href="{{ route('lessor.workspaces.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Workspaces
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Workspace Details Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">
                            <!-- Workspace Image Gallery -->
                            <div class="col-md-5">
                                <div class="workspace-gallery">
                                    @if($workspace->images)
                                        @php
                                            $images = json_decode($workspace->images);
                                        @endphp
                                        <img src="{{ asset('storage/' . $images[0]) }}"
                                             class="img-fluid rounded mb-3 main-image"
                                             alt="{{ $workspace->title }}">

                                        @if(count($images) > 1)
                                            <div class="thumbnail-container d-flex flex-wrap">
                                                @foreach($images as $index => $image)
                                                    <img src="{{ asset('storage/' . $image) }}"
                                                         class="img-thumbnail m-1"
                                                         width="80"
                                                         alt="Workspace Image {{ $index + 1 }}"
                                                         onclick="changeMainImage(this)">
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="height: 300px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Workspace Info -->
                            <div class="col-md-7">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h3 class="mb-0">{{ $workspace->title }}</h3>
                                    <span class="badge badge-{{ $workspace->status == 'available' ? 'success' : 'danger' }} p-2">
                                        {{ ucfirst($workspace->status) }}
                                    </span>
                                </div>

                                <div class="workspace-meta mb-4">
                                    <div class="d-flex flex-wrap">
                                        <div class="meta-item mr-4 mb-2">
                                            <i class="fas fa-tag text-primary mr-2"></i>
                                            <span>{{ $workspace->space_type }}</span>
                                        </div>
                                        <div class="meta-item mr-4 mb-2">
                                            <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                            <span>{{ $workspace->location }}</span>
                                        </div>
                                        <div class="meta-item mr-4 mb-2">
                                            <i class="fas fa-ruler-combined text-primary mr-2"></i>
                                            <span>{{ $workspace->size }} m²</span>
                                        </div>
                                        <div class="meta-item mr-4 mb-2">
                                            <i class="fas fa-users text-primary mr-2"></i>
                                            <span>{{ $workspace->people_capacity }} people</span>
                                        </div>
                                        <div class="meta-item mb-2">
                                            <i class="fas fa-dollar-sign text-primary mr-2"></i>
                                            <span>
                                                @if($workspace->price_per_hour)
                                                    ${{ number_format($workspace->price_per_hour, 2) }} per hour
                                                @elseif($workspace->price_per_day)
                                                    ${{ number_format($workspace->price_per_day, 2) }} per day
                                                @elseif($workspace->price_per_month)
                                                    ${{ number_format($workspace->price_per_month, 2) }} per month
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="workspace-description mb-4">
                                    <h5 class="text-primary">Description</h5>
                                    <p class="text-muted">{{ $workspace->description }}</p>
                                </div>

                                <!-- Governorate and Address -->
                                <div class="workspace-location mb-4">
                                    <h5 class="text-primary">Location Details</h5>
                                    <ul class="list-unstyled text-muted">
                                        <li class="mb-1"><i class="fas fa-building mr-2 text-primary"></i><strong>Governorate:</strong> {{ $workspace->governorate }}</li>
                                        <li class="mb-1"><i class="fas fa-map-marker-alt mr-2 text-primary"></i><strong>Address:</strong> {{ $workspace->address ?? 'Not specified' }}</li>
                                        @if($workspace->latitude && $workspace->longitude)
                                            <li class="mb-1"><i class="fas fa-globe-americas mr-2 text-primary"></i><strong>Coordinates:</strong> {{ $workspace->latitude }}, {{ $workspace->longitude }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities & Features Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4 h-100">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Amenities</h6>
                                <span class="badge badge-primary">{{ $workspace->amenities->count() }}</span>
                            </div>
                            <div class="card-body">
                                @if($workspace->amenities->count() > 0)
                                    <div class="amenities-list">
                                        @foreach($workspace->amenities as $amenity)
                                            <div class="amenity-item d-flex align-items-center mb-2">
                                                <i class="fas fa-check-circle text-success mr-2"></i>
                                                <span>{{ $amenity->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted mb-0">No amenities added yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4 h-100">
                            <div class="card-header bg-white py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pricing & Terms</h6>
                            </div>
                            <div class="card-body">
                                <ul class="feature-list">
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fas fa-clock text-primary mr-3"></i>
                                        <div>
                                            <h6 class="mb-0">Minimum Booking</h6>
                                            <p class="mb-0 text-muted">
                                                {{ $workspace->minimum_term }} {{ $workspace->minimum_term_unit }}(s)
                                            </p>
                                        </div>
                                    </li>
                                    @if($workspace->price_per_hour)
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                                            <div>
                                                <h6 class="mb-0">Hourly Rate</h6>
                                                <p class="mb-0 text-muted">
                                                    ${{ number_format($workspace->price_per_hour, 2) }}
                                                </p>
                                            </div>
                                        </li>
                                    @endif
                                    @if($workspace->price_per_day)
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                                            <div>
                                                <h6 class="mb-0">Daily Rate</h6>
                                                <p class="mb-0 text-muted">
                                                    ${{ number_format($workspace->price_per_day, 2) }}
                                                </p>
                                            </div>
                                        </li>
                                    @endif
                                    @if($workspace->price_per_month)
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                                            <div>
                                                <h6 class="mb-0">Monthly Rate</h6>
                                                <p class="mb-0 text-muted">
                                                    ${{ number_format($workspace->price_per_month, 2) }}
                                                </p>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video & Map Section -->
                <div class="row">
                    @if($workspace->video_link)
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Virtual Tour</h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $workspace->video_link }}" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="{{ $workspace->video_link ? 'col-md-6' : 'col-md-12' }}">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Location Map</h6>
                            </div>
                            <div class="card-body p-0">
                                @if($workspace->latitude && $workspace->longitude)
                                    <div id="workspace-map" style="height: 300px;"></div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-map-marker-alt fa-3x text-muted mb-2"></i>
                                        <p class="text-muted">Location coordinates not available</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Reuse the same styles from dashboard */
    :root {
        --sidebar-width: 250px;
        --sidebar-bg: #2c3e50;
        --sidebar-active-bg: #34495e;
        --sidebar-text: #ecf0f1;
        --sidebar-active-text: #3498db;
        --main-bg: #f8f9fc;
        --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    body {
        background-color: var(--main-bg);
        overflow-x: hidden;
    }

    .db-main-container {
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .db-sidenav-container {
        background-color: var(--sidebar-bg);
        min-height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        width: var(--sidebar-width);
        z-index: 1000;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: all 0.3s;
    }

    .db-sidebar-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .db-sidebar-nav .nav-link {
        color: #ffffff !important;
        padding: 12px 20px;
        margin: 2px 0;
        border-radius: 0;
        transition: all 0.3s;
    }

    .db-sidebar-nav .nav-link:hover {
        background-color: var(--sidebar-active-bg);
        color: var(--sidebar-active-text);
    }

    .db-sidebar-nav .nav-link.active {
        background-color: var(--sidebar-active-bg);
        color: var(--sidebar-active-text);
        border-left: 4px solid var(--sidebar-active-text);
    }

    .db-sidebar-nav .nav-link i {
        width: 20px;
        text-align: center;
    }

    .db-sidebar-footer {
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    /* Main Content Styles */
    .db-main-content {
        margin-left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 0.35rem;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
    }

    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    /* Workspace Specific Styles */
    .workspace-gallery {
        position: relative;
    }

    .main-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 0.35rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .thumbnail-container {
        margin-top: 10px;
    }

    .thumbnail-container img {
        cursor: pointer;
        transition: all 0.3s;
    }

    .thumbnail-container img:hover {
        opacity: 0.8;
        transform: scale(1.05);
    }

    .meta-item {
        display: flex;
        align-items: center;
    }

    .amenities-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .feature-list li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .feature-list li:last-child {
        border-bottom: none;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .db-sidenav-container {
            width: 80px;
            overflow: hidden;
        }

        .db-main-content {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        .db-sidebar-header,
        .db-sidebar-nav .nav-link span,
        .db-sidebar-footer .btn span {
            display: none;
        }

        .db-sidebar-nav .nav-link {
            text-align: center;
            padding: 12px 5px;
        }

        .db-sidebar-nav .nav-link i {
            margin-right: 0;
            font-size: 1.2rem;
        }
    }

    @media (max-width: 768px) {
        .db-sidenav-container {
            width: 0;
        }

        .db-main-content {
            margin-left: 0;
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add active class to current nav item
        const currentPath = window.location.pathname;
        document.querySelectorAll('.db-sidebar-nav .nav-link').forEach(link => {
            if (link.href.includes(currentPath)) {
                link.classList.add('active');
            }
        });

        // Function to change main image when clicking on thumbnails
        window.changeMainImage = function(element) {
            const newSrc = element.getAttribute('src');
            document.querySelector('.main-image').setAttribute('src', newSrc);
        };
    });

    @if($workspace->latitude && $workspace->longitude)
        function initMap() {
            const location = {
                lat: {{ $workspace->latitude }},
                lng: {{ $workspace->longitude }}
            };
            const map = new google.maps.Map(document.getElementById("workspace-map"), {
                zoom: 15,
                center: location,
            });

            new google.maps.Marker({
                position: location,
                map,
                title: "{{ $workspace->title }}",
            });
        }
    @endif
</script>
@if($workspace->latitude && $workspace->longitude)
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
@endif
@endpush
