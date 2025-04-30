@extends('layouts.app')

@section('content')
    <div class="hero-slider-section" style="background: url('{{ asset('assets/images/hero-slide-img-1.jpg') }}'); background-size: cover;">
        <div class="py-lg-18 py-10 px-6">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="mb-4">
                        <h1 class="text-white font-weight-bold mb-0">Forgot Your Password?</h1>
                        <p class="lead text-white">No worries! We will send you a link to reset your password.</p>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf  <!-- CSRF Token for security -->

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            />
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-secondary btn-block btn-lg">
                            Send Password Reset Link
                        </button>
                    </form>

                    <!-- Back to Login Link -->
                    <div class="mt-3">
                        <p class="mb-0">
                            Remember your password? <a href="{{ route('auth.login') }}">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
