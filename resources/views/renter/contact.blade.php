@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<!-- pageheader start -->
<div class="pageheader" style="background: url({{ asset('assets/images/pageheader-img.jpg') }}); background-repeat: no-repeat; background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="pageheader-caption">
          <h1 class="pageheader-caption-title">Say Hello, Stranger</h1>
          <p class="pageheader-caption-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi fringilla ipsum tellus lorem id blandit.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- pageheader close -->

<!-- breadcrumb start -->
<div class="container">
  <div class="row">
    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
      <div class="custom-breadcrumb">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('renter.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Contact</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- breadcrumb close -->

<div class="pt-lg-10 pb-lg-10 pb-5 pt-5">
  <div class="container">
    <div class="row">
      <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- contact form start -->
        <div class="contact-form">
          <h3 class="mb-5">Hello there, how can we help you?</h3>
          @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
          @endif

          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

          <form class="form-row" action="{{ route('renter.contact.submit') }}" method="POST">
            @csrf
            <div class="form-group col-6">
              <label for="name">Name<span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" id="name" placeholder="John Deo" required>
            </div>
            <div class="form-group col-6">
              <label for="email">Email<span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com" required>
            </div>
            <div class="form-group col-12">
              <label for="phone">Phone<span class="text-danger">*</span></label>
              <input type="tel" name="phone" class="form-control" id="phone" placeholder="+962" required>
            </div>
            <div class="form-group col-12">
              <label for="message">Message</label>
              <textarea class="form-control" name="message" id="message" rows="4" placeholder="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
            <span class="text-danger-text"><span class="text-danger">*</span> Required Field</span>
          </form>
        </div>
        <!-- contact form close -->
      </div>
    </div>
  </div>
</div>
@endsection
