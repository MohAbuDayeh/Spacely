@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <div class="pageheader" style="background: url({{ asset('assets/images/home3.png') }}); background-repeat: no-repeat; background-size: cover;">

        <div class="hero-overlay"></div>
        <div class="container position-relative z-index-1 py-5">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-12 text-center py-4 px-3">
                    <h1 class="text-white font-weight-bold mb-3 display-4">Connect With Our Team</h1>
                    <p class="lead text-white mb-4" style="font-size: 1.25rem; line-height: 1.6;">
                        We're here to help and answer any questions you might have. We look forward to hearing from you.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent px-0 py-2">
                <li class="breadcrumb-item"><a href="{{ route('renter.dashboard') }}" class="text-primary">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>

    <!-- Contact Form Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="mb-5 text-center">
                        <span class="badge bg-primary-soft text-primary mb-3">GET IN TOUCH</span>
                        <h2 class="mb-3">Hello there, how can we help you?</h2>
                        <p class="text-muted">
                            Fill out the form below and our team will get back to you as soon as possible.
                        </p>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card border-2 border-primary shadow-sm hover-lift">
                        <div class="card-body p-4">
                            <form action="{{ route('renter.contact.submit') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control border-2" id="name" placeholder="John Doe" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control border-2" id="email" placeholder="example@gmail.com" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control border-2" id="phone" placeholder="+962" required>
                                </div>
                                <div class="mb-4">
                                    <label for="message" class="form-label fw-bold">Your Message</label>
                                    <textarea class="form-control border-2" name="message" id="message" rows="4" placeholder="How can we help you?"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg px-4 py-2 hover-scale">
                                        Send Message
                                    </button>
                                </div>
                                <div class="mt-2 text-center text-muted">
                                    <small><span class="text-danger">*</span> indicates required fields</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3">Other Ways to Reach Us</h2>
                    <p class="text-muted">
                        Prefer another method of communication? Here's how else you can get in touch.
                    </p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card border-2 border-primary h-100 hover-lift text-center p-3">
                        <div class="card-body">
                            <div class="bg-primary-soft rounded-circle mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <h3 class="h5 mb-2">Our Location</h3>
                            <p class="text-muted mb-0">
                                123 Business Avenue<br>
                                Amman, Jordan
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-2 border-primary h-100 hover-lift text-center p-3">
                        <div class="card-body">
                            <div class="bg-primary-soft rounded-circle mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-phone-alt fa-2x text-primary"></i>
                            </div>
                            <h3 class="h5 mb-2">Phone Number</h3>
                            <p class="text-muted mb-0">
                                +962 6 123 4567<br>
                                Mon-Fri, 9am-5pm
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-2 border-primary h-100 hover-lift text-center p-3">
                        <div class="card-body">
                            <div class="bg-primary-soft rounded-circle mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-envelope fa-2x text-primary"></i>
                            </div>
                            <h3 class="h5 mb-2">Email Address</h3>
                            <p class="text-muted mb-0">
                                info@spacely.com<br>
                                support@spacely.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
