@extends('layouts.lessor')

@section('pageTitle', 'Workspaces Management')

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
                                href="#">
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

        <!-- content start -->
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <!-- Header Section -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="db-pageheader d-flex justify-content-between mb-4">
                        <h2 class="h3 mb-0">Add New Workspace</h2>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('lessor.workspaces.index') }}" class="btn btn-primary">Back to Workspaces</a>
                        </div>
                    </div>

                    <!-- Form Section -->
                    <form action="{{ route('lessor.workspaces.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Category Selection -->
                        <div class="card listing-category mb-2">
                            <h3 class="card-header h6 bg-white">Select Category</h3>
                            <div class="card-body">
                                <select class="select2 form-control" id="category" name="category">
                                    <option selected>Select Your Category</option>
                                    <option value="1">Coworking space</option>
                                    <option value="2">Meeting space</option>
                                    <option value="3">Office space</option>
                                </select>
                            </div>
                        </div>

                        <!-- Workspace Details -->
                        <div class="card listing-details mb-2">
                            <h3 class="card-header h6 bg-white">Workspace Details</h3>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Your Office Space title" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Space Address" required>
                                </div>
                            </div>
                        </div>
                        <!-- Workspace Size Section -->
                        <div class="card listing-size mb-2">
                            <h3 class="card-header h6 bg-white">Workspace Size</h3>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="size">Size (m²)</label>
                                    <input type="number" class="form-control" id="size" name="size"
                                        placeholder="Enter workspace size" required>
                                </div>
                            </div>
                        </div>

                        <!-- People Capacity Section -->
                        <div class="card listing-capacity mb-2">
                            <h3 class="card-header h6 bg-white">People Capacity</h3>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="people_capacity">Number of People</label>
                                    <input type="number" class="form-control" id="people_capacity" name="people_capacity"
                                        placeholder="Enter number of people it can accommodate" required>
                                </div>
                            </div>
                        </div>


                        <!-- Listing Price Section -->
                        <div class="card listing-price mb-2">
                            <h3 class="card-header h6 bg-white">Workspaces Price</h3>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="type">Select Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option selected>Hourly</option>
                                        <option value="1">Monthly</option>
                                        <option value="2">Daily</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        placeholder="$20" required>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="card listing-description mb-2">
                            <h3 class="card-header h6 bg-white">Workspace Descriptions</h3>
                            <div class="card-body p-0">
                                <textarea class="form-control" name="description" placeholder="Describe your space here" rows="5"></textarea>
                            </div>
                        </div>


                        <!-- Listing Amenities Section -->
                        <div class="card listing-amenities mb-2">
                            <h3 class="card-header bg-white h6">Workspace Amenities</h3>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($amenities as $amenity)
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="amenity{{ $amenity->id }}" name="amenities[]"
                                                    value="{{ $amenity->id }}">
                                                <label class="custom-control-label"
                                                    for="amenity{{ $amenity->id }}">{{ $amenity->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- Image Upload Section -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Service Images</label>
                            <div class="image-upload-container">
                                <div class="dropzone" id="service-images-dropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                        <h5>Drag & drop images here</h5>
                                        <p class="text-muted">or click to browse (max 5 images)</p>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Showcase your work with high-quality images</small>
                        </div>

                        <!-- Video Section -->
                        <div class="card listing-video mb-2">
                            <h3 class="card-header h6 bg-white">Workspace Video</h3>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="videolink">Video Link</label>
                                    <input type="url" class="form-control" id="videolink" name="video_link"
                                        placeholder="Your video link here">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <button type="submit" class="btn btn-primary">Submit Listing</button>
                        </div>
                    </form>
                </div>
            </div>
            <div> </div>

            <!-- Scripts Section -->
            <script>
                // Initialize TinyMCE Editor
                tinymce.init({
                    selector: ".editor-textarea",
                    readonly: false // Allow editing
                });

                // Initialize Dropzone
                new Dropzone("#service-images-dropzone", {
                    url: '{{ route('moh') }}', // Use the correct URL for your route
                    paramName: "image",
                    maxFiles: 5,
                    acceptedFiles: "image/*",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    addRemoveLinks: true
                }).on("success", function(file, response) {
                    // Handle successful upload
                    console.log("File uploaded successfully:", response);
                    // store it in a hidden input field
                    var hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "images[]");
                    hiddenInput.setAttribute("value", response.path);
                    file.previewElement.appendChild(hiddenInput);
                }).on("error", function(file, response) {
                    // Handle error
                    console.error("Error uploading file:", response);
                }).on("removedfile", function(file) {
                    // Handle file removal
                    console.log("File removed:", file.name);
                });
            </script>
        @endsection
