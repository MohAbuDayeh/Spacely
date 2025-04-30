@extends('layouts.lessor')

@section('pageTitle', 'Lessor Dashboard')

@section('content')
    <div class="row">
        <!-- Sidebar Section -->
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <nav class="navbar navbar-expand-lg db-sidenav">
                <div class="collapse navbar-collapse" id="navbardbCollapse">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.dashboard') ? 'active' : '' }}"
                                href="{{ route('lessor.dashboard') }}">
                                <i class="fas fa-fw fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.workspaces.index') ? 'active' : '' }}"
                                href="{{ route('lessor.workspaces.index') }}">
                                <i class="fas fa-fw fa-list"></i>Workspaces
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.request-quote') ? 'active' : '' }}"
                                href="{{ route('lessor.request-quotes') }}">
                                <i class="fas fa-fw fa-receipt"></i>Request Quote
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.reviews') ? 'active' : '' }}"
                                href="{{ route('lessor.reviews') }}">
                                <i class="fas fa-fw fa-star"></i>Reviews
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.invoices.index') ? 'active' : '' }}"
                                href="{{ route('lessor.invoices.index') }}">
                                <i class="fas fa-fw fa-file-invoice"></i>Invoice
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.profile') ? 'active' : '' }}" href="#">
                                <i class="fas fa-fw fa-user-circle"></i>Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="fas fa-fw fa-sign-out-alt"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Main Content Section -->
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mb-4">
                        <h2 class="h3 mb-0">Dashboard</h2>
                        <p>Welcome to your dashboard, here you can manage your workspaces, reviews, and requests.</p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Widgets -->
            <div class="row">
                <!-- Listings Widget -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6 mb-4">Workspaces</h3>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">{{ $workspacesCount }}</h3>
                                <span class="db-overview-widget-body-icon">
                                    <i class="fas fa-list icon-shape icon-lg text-primary bg-light rounded-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Widget -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6 mb-4">Reviews</h3>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">{{ $reviewsCount }}</h3>
                                <span class="db-overview-widget-body-icon">
                                    <i class="fas fa-star icon-shape icon-lg text-primary bg-light rounded-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Quote Widget -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6 mb-4">Request Quote</h3>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">{{ $quotesCount }}</h3>
                                <span class="db-overview-widget-body-icon">
                                    <i class="fas fa-file-invoice icon-shape icon-lg text-primary bg-light rounded-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Reviews Section -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                    <div class="card">
                        <h3 class="card-header bg-white h6 mb-0 border-bottom-0">Recent Reviews</h3>
                        <div class="db-card-body table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @foreach($recentReviews as $review)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="">
                                                <img src="../assets/images/avatar-3.jpg" alt="" class="rounded-circle icon-shape icon-sm" />
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $review->user->name }}</td>
                                        <td class="align-middle">{{ $review->workspace->title }}</td>
                                        <td class="align-middle">{{ $review->created_at->format('d M Y') }}</td>
                                        <td class="align-middle">
                                            <div class="font-12">
                                                @for($i = 0; $i < $review->rating; $i++)
                                                    <span class="fas fa-star text-warning"></span>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-body border-top">
                                <a href="{{ route('lessor.reviews') }}" class="btn btn-primary btn-sm">See All Reviews</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Request Quote Section -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <h3 class="card-header bg-white h6 mb-0 border-bottom-0">Recent Request Quote</h3>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @foreach($recentQuotes as $quote)
                                    <tr>
                                        <td class="align-middle">{{ $quote->user->name }}</td>
                                        <td class="align-middle">{{ $quote->user->email }}</td>
                                        <td class="align-middle">{{ $quote->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-body border-top">
                                <a href="{{ route('lessor.request-quotes') }}" class="btn btn-primary btn-sm">See Quotes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
