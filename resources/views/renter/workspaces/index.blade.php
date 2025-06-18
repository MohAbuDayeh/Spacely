@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}">
    <style>
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

        .workspace-img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .workspace-card:hover .workspace-img {
            transform: scale(1.05);
        }

        .workspace-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .featured-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .filter-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .filter-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
            font-weight: 600;
        }

        .filter-section {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .page-header {
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            position: relative;
            margin-bottom: 40px;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .page-header-content {
            position: relative;
            z-index: 1;
            color: white;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .page-description {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: #6c757d;
        }

        .breadcrumb-item.active {
            color: var(--primary);
        }

        .sort-dropdown {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 8px 15px;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .pagination .page-link {
            color: var(--primary);
        }
    </style>
@endsection

@section('content')
    <!-- Page Header Section -->
    <div class="page-header" style="background-image: url('{{ asset('assets/images/home2.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="page-header-content">
                        <h1 class="page-title">Find Your Perfect Workspace</h1>
                        <p class="page-description">
                            Discover and book the ideal workspace for your needs with flexible options and locations.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb Section -->
    <div class="container mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Workspaces</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content Section -->
    <div class="container">
        <div class="row">
            <!-- Workspaces Listing Column -->
            <div class="col-lg-9 order-lg-1 order-2">
                <!-- Sorting and Filter Options -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h3 class="mb-0">{{ $workspaces->total() }} Workspaces Available</h3>
                    </div>
                    <div class="col-md-4">
                        <select class="sort-dropdown form-control" id="search-hide">
                            <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sort by</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        </select>
                    </div>
                </div>

                <!-- Workspaces Grid -->
                <div class="row">
                    @foreach($workspaces as $workspace)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card workspace-card h-100">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ route('renter.workspaces.show', $workspace->id) }}">
                                        @php
                                            $workspaceImages = json_decode($workspace->images, true);
                                            $imageUrl = isset($workspaceImages[0]) ? asset('storage/' . $workspaceImages[0]) : asset('assets/images/default-workspace.jpg');
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $workspace->title }}" class="img-fluid workspace-img w-100">

                                        @if($workspace->is_featured)
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
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $workspace->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif($i - 0.5 <= $workspace->rating)
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        <small class="ms-1">({{ $workspace->reviews_count }})</small>
                                    </div>

                                    <div class="d-flex justify-content-between border-top pt-3">
                                        <div>
                                            <span class="d-block small text-muted">Price</span>
                                            @if($workspace->price_per_hour)
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

                <!-- Pagination -->
                <div class="row mt-4">
                    <div class="col-12">
                        {{ $workspaces->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

            <!-- Filters Sidebar Column -->
            <div class="col-lg-3 order-lg-2 order-1 mb-4 mb-lg-0">
                <form id="filter-form" method="GET" action="{{ route('renter.workspaces.index') }}">
                    <div class="card filter-card">
                        <div class="filter-header">
                            <i class="fas fa-sliders-h text-primary me-2"></i> Filters
                        </div>

                        <!-- Location Filter (Jordan Governorates) -->
                        <div class="filter-section">
                            <div class="filter-title" data-toggle="collapse" data-target="#locationFilter">
                                <span>Location</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="locationFilter">
                                <div class="mt-3">
                                    @foreach([
                                        'Amman' => 'Amman',
                                        'Zarqa' => 'Zarqa',
                                        'Irbid' => 'Irbid',
                                        'Aqaba' => 'Aqaba',
                                        'Mafraq' => 'Mafraq',
                                        'Balqa' => 'Balqa',
                                        'Karak' => 'Karak',
                                        'Madaba' => 'Madaba',
                                        'Tafilah' => 'Tafilah',
                                        'Jerash' => 'Jerash',
                                        'Ajloun' => 'Ajloun',
                                        'Ma\'an' => 'Ma\'an'
                                    ] as $gov => $label)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="governorate"
                                                   id="gov{{ $loop->index }}" value="{{ $gov }}"
                                                   {{ request('governorate') == $gov ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gov{{ $loop->index }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Capacity Filter -->
                        <div class="filter-section">
                            <div class="filter-title" data-toggle="collapse" data-target="#capacityFilter">
                                <span>Capacity</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="capacityFilter">
                                <div class="mt-3">
                                    @foreach([
                                        '1' => '1 Person',
                                        '2-5' => '2-5 People',
                                        '5-10' => '5-10 People',
                                        '10-15' => '10-15 People',
                                        '15+' => '15+ People'
                                    ] as $value => $label)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="capacity_range"
                                                   id="capacity{{ $loop->index }}" value="{{ $value }}"
                                                   {{ request('capacity_range') == $value ? 'checked' : '' }}>
                                            <label class="form-check-label" for="capacity{{ $loop->index }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Space Type Filter -->
                        <div class="filter-section">
                            <div class="filter-title" data-toggle="collapse" data-target="#typeFilter">
                                <span>Space Type</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="typeFilter">
                                <div class="mt-3">
                                    @foreach($spaceTypes as $type => $count)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="space_type"
                                                   id="type{{ $loop->index }}" value="{{ $type }}"
                                                   {{ request('space_type') == $type ? 'checked' : '' }}>
                                            <label class="form-check-label" for="type{{ $loop->index }}">
                                                {{ $type }} ({{ $count }})
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="filter-section">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-filter mr-2"></i> Apply Filters
                            </button>
                            @if(request()->hasAny(['governorate', 'capacity_range', 'space_type', 'sort']))
                                <a href="{{ route('renter.workspaces.index') }}" class="btn btn-outline-secondary btn-block mt-2">
                                    <i class="fas fa-times mr-2"></i> Clear Filters
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize select2
            $('.sort-dropdown').select2({
                minimumResultsForSearch: Infinity
            });

            // Submit form when sorting changes
            $('#search-hide').change(function() {
                $('#filter-form').append('<input type="hidden" name="sort" value="' + $(this).val() + '">');
                $('#filter-form').submit();
            });

            // Auto-submit when radio buttons change
            $('input[type="radio"]').change(function() {
                $('#filter-form').submit();
            });

            // Toggle filter sections
            $('.filter-title').click(function() {
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
            });

            // Wishlist button functionality
            $('.btn-wishlist').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Saved to Wishlist",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
@endsection
