@extends('layouts.lessor')

@section('pageTitle', 'Lessor Dashboard')

@section('content')
    <div class="row no-gutters db-main-container">
        <!-- Sidebar Section - Professional Design -->
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
                <!-- Dashboard Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="h4 font-weight-bold text-dark mb-1">Dashboard Overview</h2>
                                <p class="mb-0 text-muted">Welcome back, {{ Auth::user()->name }}!</p>
                            </div>
                            <div class="db-date-display bg-white p-2 rounded shadow-sm">
                                <i class="far fa-calendar-alt mr-2 text-primary"></i>
                                <span id="current-date">{{ now()->format('l, F j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Workspaces</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $workspacesCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Reviews</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reviewsCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-star fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Request Quotes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $quotesCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Reviews Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Recent Reviews</h6>
                                <a href="{{ route('lessor.reviews') }}" class="btn btn-sm btn-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>User</th>
                                                <th>Workspace</th>
                                                <th>Date</th>
                                                <th>Rating</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentReviews as $review)
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $review->user->image ? asset('storage/' . $review->user->image) : asset('assets/images/avatar-3.jpg') }}"
                                                             alt="{{ $review->user->name }}"
                                                             class="rounded-circle mr-2"
                                                             width="40">
                                                        <span>{{ $review->user->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">{{ $review->workspace->title }}</td>
                                                <td class="align-middle">{{ $review->created_at->format('M d, Y') }}</td>
                                                <td class="align-middle">
                                                    <div class="rating-stars">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <i class="fas fa-star {{ $i < $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                        @endfor
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-sm btn-outline-primary">Details</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Quotes Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Recent Request Quotes</h6>
                                <a href="{{ route('lessor.request-quotes') }}" class="btn btn-sm btn-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentQuotes as $quote)
                                            <tr>
                                                <td class="align-middle">{{ $quote->user->name }}</td>
                                                <td class="align-middle">{{ $quote->user->email }}</td>
                                                <td class="align-middle">{{ $quote->created_at->format('M d, Y') }}</td>
                                                <td class="align-middle">
                                                    <span class="badge badge-warning">Pending</span>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-sm btn-outline-primary">Respond</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
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
        // Update current date
        function updateCurrentDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const now = new Date();
            document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
        }

        updateCurrentDate();

        // Add active class to current nav item
        const currentPath = window.location.pathname;
        document.querySelectorAll('.db-sidebar-nav .nav-link').forEach(link => {
            if (link.href.includes(currentPath)) {
                link.classList.add('active');
            }
        });
    });
</script>
@endpush
