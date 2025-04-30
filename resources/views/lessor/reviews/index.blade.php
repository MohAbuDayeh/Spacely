@extends('layouts.lessor')

@section('pageTitle', 'Listing Reviews - Space Reviews')

@section('content')
<div class="row">
    <!-- Sidebar Section -->
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <nav class="navbar navbar-expand-lg db-sidenav">
            <div class="collapse navbar-collapse" id="navbardbCollapse">
                <ul class="nav flex-column">
                    <!-- Dashboard Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.dashboard') ? 'active' : '' }}" href="{{ route('lessor.dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>

                    <!-- Workspaces Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.workspaces.index') ? 'active' : '' }}" href="{{ route('lessor.workspaces.index') }}">
                            <i class="fas fa-fw fa-list"></i>Workspaces
                        </a>
                    </li>

                    <!-- Request Quote Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.request-quote') ? 'active' : '' }}" href="#">
                            <i class="fas fa-fw fa-receipt"></i>Request Quote
                        </a>
                    </li>

                    <!-- Reviews Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.reviews') ? 'active' : '' }}" href="{{ route('lessor.reviews') }}">
                            <i class="fas fa-fw fa-star"></i>Reviews
                        </a>
                    </li>

                    <!-- Invoice Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.invoices.index') ? 'active' : '' }}" href="{{ route('lessor.invoices.index') }}">
                            <i class="fas fa-fw fa-file-invoice"></i>Invoice
                        </a>
                    </li>

                    <!-- Profile Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.profile') ? 'active' : '' }}" href="#">
                            <i class="fas fa-fw fa-user-circle"></i>Profile
                        </a>
                    </li>

                    <!-- Logout Link -->
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

    <!-- Content Start -->
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <!-- Header Section -->
        <div class="db-pageheader d-flex justify-content-between mb-4">
            <div class="">
                <h2 class="h3 mb-0">Reviews</h2>
                <p class="db-pageheader-text">Here are all the reviews for your listings.</p>
            </div>
            <div class="d-xl-flex align-items-center">
                <a href="#" class="btn btn-primary">Ask Reviews</a>
            </div>
        </div>

        <!-- Reviews List -->
        <div class="row">
            @foreach($reviews as $review)
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-xl-flex justify-content-between">
                                <div class="review-content-head">
                                    <h3 class="h4">{{ $review->user->name }}</h3>
                                    <div class="mb-3 font-12">
                                        @for($i = 0; $i < $review->rating; $i++)
                                            <span class="fas fa-star text-warning"></span>
                                        @endfor
                                        @for($i = $review->rating; $i < 5; $i++)
                                            <span class="fas fa-star text-light"></span>
                                        @endfor
                                        <a href="listing-single.html" class="badge badge-success ml-2">{{ $review->rating }}</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-2">{{ $review->workspace->title }}</h5>
                            <p class="review-content-text">
                                {{ $review->comment }}
                            </p>

                            <!-- عرض الرد إذا كان موجوداً -->
                            @if($review->response)
                                <div class="review-response mt-2">
                                    <strong>Response:</strong>
                                    <p>{{ $review->response }}</p>
                                </div>
                            @endif

                            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#respond{{ $review->id }}" role="button" aria-expanded="false" aria-controls="respond{{ $review->id }}">Respond</a>
                        </div>
                    </div>
                </div>

                <!-- Collapse for Responding to Review -->
                <div class="collapse" id="respond{{ $review->id }}">
                    <div class="card">
                        <h5 class="card-header bg-white h6">Respond to review</h5>
                        <div class="card-body">
                            <form action="{{ route('lessor.reviews.respond', $review->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="response">Write Your Response</label>
                                    <textarea class="form-control" id="response" name="response" rows="3" placeholder="Write your response here"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <a class="btn btn-outline-primary btn-sm" data-toggle="collapse" href="#respond{{ $review->id }}" role="button" aria-expanded="false" aria-controls="respond{{ $review->id }}">Close</a>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
@endsection
