@extends('layouts.app')

@section('content')
    <div class="hero-slider-section" style="background: url('{{ asset('assets/images/hero-slide-img-1.jpg') }}'); background-size: cover;">
        <div class="py-lg-18 py-10 px-6">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="mb-4">
                        <h1 class="text-white font-weight-bold mb-0">The Best Offices to Work in Your City</h1>
                        <p class="lead text-white">Book from thousands of unique work and meeting spaces.</p>
                    </div>
                    <form class="form-row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 mb-2 mb-lg-0">
                            <select class="select2 form-control custom-select">
                                <option>Search By Location</option>
                                <option value="Amman">Amman</option>
                                <option value="Zarqa">Zarqa</option>
                                <option value="Irbid">Irbid</option>
                                <option value="Mafraq">Mafraq</option>
                                <option value="Jerash">Jerash</option>
                                <option value="Ajloun">Ajloun</option>
                                <option value="Balqa">Balqa</option>
                                <option value="Karak">Karak</option>
                                <option value="Tafilah">Tafilah</option>
                                <option value="Ma'an">Ma'an</option>
                                <option value="Aqaba">Aqaba</option>
                                <option value="Madaba">Madaba</option>
                            </select>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 mb-2 mb-lg-0">
                            <select class="select2 form-control custom-select">
                                <option>All Space</option>
                                <option value="Meeting Space">Meeting Space</option>
                                <option value="Coworking Space">Coworking Space</option>
                                <option value="Office space">Office space</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <a href="{{ route('workspaces.create') }}" class="btn btn-primary btn-block btn-lg">Search</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Space Showcase Section -->
    <div class="pb-5 pt-5 py-lg-12">
        <div class="container-fluid">
            <h2 class="text-center mb-4">Types of office space available</h2>
            <p class="lead text-center">Explore the different types of office space available to rent.</p>

            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="{{ route('workspaces.show', 1) }}" class="space-showcase-block">
                        <div class="overlay-bg zoom-img mb-4 mb-lg-0">
                            <img src="{{ asset('assets/images/space-img-1.jpg') }}" alt="" class="img-fluid rounded">
                            <div class="title">
                                <h3 class="h5 text-white mb-0">Meeting space</h3>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="{{ route('workspaces.show', 2) }}" class="space-showcase-block">
                        <div class="overlay-bg zoom-img mb-4 mb-lg-0">
                            <img src="{{ asset('assets/images/space-img-2.jpg') }}" alt="" class="img-fluid rounded">
                            <div class="title">
                                <h3 class="h5 text-white mb-0">Coworking space</h3>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="{{ route('workspaces.show', 3) }}" class="space-showcase-block">
                        <div class="overlay-bg zoom-img mb-4 mb-lg-0">
                            <img src="{{ asset('assets/images/space-img-3.jpg') }}" alt="" class="img-fluid rounded">
                            <div class="title">
                                <h3 class="h5 text-white mb-0">Office space</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Office Spaces Section -->
    <div class="pb-lg-16 pb-5 pt-5">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="mb-lg-8 mb-5">
                        <h1>Explore our available office spaces</h1>
                        <p class="lead">Etiam condimentum augue ac nunc commodo euismo aecenas vitae lectus ornare, ornare velit nec, volutpat lacus.</p>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 text-right">
                    <a href="{{ route('workspaces.index') }}" class="btn btn-outline-primary">Browse All Space</a>
                </div>
            </div>

            <div class="row">
                <!-- Loop through workspaces and display each -->
                @foreach ($workspaces as $workspace)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card mb-4 mb-lg-0">
                            <div class="card-img position-relative">
                                <a href="{{ route('workspaces.show', $workspace->id) }}">
                                    <img src="{{ asset('assets/images/' . $workspace->image) }}" alt="{{ $workspace->title }}" class="img-fluid rounded-top w-100">
                                </a>
                                <a href="{{ route('workspaces.show', $workspace->id) }}" class="badge badge-success card-overlay-category">{{ $workspace->space_type }}</a>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <a href="{{ route('workspaces.show', $workspace->id) }}">
                                        <h3 class="h5 mb-1 text-truncate">{{ $workspace->title }}</h3>
                                    </a>
                                    <p class="font-14">{{ $workspace->location }}</p>
                                </div>
                                <div class="mb-3 small">
                                    @for ($i = 0; $i < 5; $i++)
                                        <span class="fas fa-star {{ $i < $workspace->rating ? 'text-warning' : 'text-muted' }}"></span>
                                    @endfor
                                    <a href="{{ route('workspaces.show', $workspace->id) }}" class="badge badge-success ml-1">{{ $workspace->rating }}</a>
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

    <!-- How it Works Section -->
    <div class="py-5 py-lg-14 bg-light">
        <div class="container">
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mb-lg-8 mb-5 text-center">
                        <h1>How it Works?</h1>
                        <p class="lead">Aliquam sagittis consectetur ligulan aliquam turpis cursus at. In aliquet augue nec libero ultricies velit pellentesque.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card text-center mb-8 mb-lg-0">
                        <div class="icon-shape bg-white border ml-auto mr-auto rounded-circle icon-xl m-n6 h3">1</div>
                        <div class="card-body p-6">
                            <div class="pb-5 mt-6">
                                <img src="{{ asset('assets/images/location-map.png') }}" alt="">
                            </div>
                            <h3 class="h4">List your space</h3>
                            <p class="mb-0">It takes no longer than 15 minutes to list your space on spacely. Our user-friendly onboarding process!</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card text-center mb-8 mb-lg-0">
                        <div class="icon-shape bg-white border ml-auto mr-auto rounded-circle icon-xl m-n6 h3">2</div>
                        <div class="card-body p-6">
                            <div class="pb-5 mt-6">
                                <img src="{{ asset('assets/images/graph-icon.png') }}" alt="">
                            </div>
                            <h3 class="h4">Get more orders</h3>
                            <p class="mb-0">Right after you complete the onboarding process, we will publish your workspace on our marketplace.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card text-center mb-8 mb-lg-0">
                        <div class="icon-shape bg-white border ml-auto mr-auto rounded-circle icon-xl m-n6 h3">3</div>
                        <div class="card-body p-6">
                            <div class="pb-5 mt-6">
                                <img src="{{ asset('assets/images/money-icon.png') }}" alt="">
                            </div>
                            <h3 class="h4">Earn money</h3>
                            <p class="mb-0">Orders coming from spacely are 100% prepaid. We will bring you not just leads but new clients.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-5">
                    <a href="{{ route('auth.register') }}" class="btn btn-outline-primary">List your space</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Market Leaders Section -->
    <div class="pt-lg-14 pb-lg-14 pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mb-lg-8 mb-5 text-center">
                        <h1>Market leaders are already with us</h1>
                        <p class="lead">The largest coworking and smart office spaces across the world chose to work with us.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="mb-3 p-3 mb-lg-0">
                        <img src="{{ asset('assets/images/logo-buffer.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="mb-3 p-3 mb-lg-0">
                        <img src="{{ asset('assets/images/logo-buzzumo.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="mb-3 p-3 mb-lg-0">
                        <img src="{{ asset('assets/images/logo-clearbit.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="mb-3 p-3 mb-lg-0">
                        <img src="{{ asset('assets/images/logo-converkit.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="mb-3 p-3 mb-lg-0">
                        <img src="{{ asset('assets/images/logo-envato.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="mb-3 p-3 mb-lg-0">
                        <img src="{{ asset('assets/images/logo-frame.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
