@extends('layouts.lessor')

@section('pageTitle', 'Edit Workspace')

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
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h4 font-weight-bold text-dark mb-1">Edit Workspace</h2>
                            <p class="mb-0 text-muted">Update your workspace details</p>
                        </div>
                        <a href="{{ route('lessor.workspaces.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Listings
                        </a>
                    </div>
                </div>
            </div>
    <!-- Main Form Section -->
    <div class="row">
        <div class="col-12">
            <form action="{{ route('lessor.workspaces.update', $workspace->id) }}" method="POST" enctype="multipart/form-data" class="workspace-form">
                @csrf
                @method('PUT')

                <!-- Form Steps Indicator -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <ul class="nav nav-pills nav-fill form-steps">
                            <li class="nav-item">
                                <a class="nav-link active" data-step="1" href="#">
                                    <i class="fas fa-layer-group mr-2"></i>Basic Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" data-step="2" href="#">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Location
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" data-step="3" href="#">
                                    <i class="fas fa-tags mr-2"></i>Pricing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" data-step="4" href="#">
                                    <i class="fas fa-camera mr-2"></i>Media
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Step 1: Basic Information -->
                <div class="card mb-4 shadow-sm form-step" id="step-1">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-layer-group text-primary mr-2"></i>Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category" class="font-weight-bold">Category</label>
                            <select class="form-control select2" id="category" name="category" required>
                                <option value="" disabled>Select Category</option>
                                <option value="1" {{ $workspace->space_type == 'Coworking space' ? 'selected' : '' }}>Coworking space</option>
                                <option value="2" {{ $workspace->space_type == 'Meeting space' ? 'selected' : '' }}>Meeting space</option>
                                <option value="3" {{ $workspace->space_type == 'Private Office' ? 'selected' : '' }}>Private Office</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Workspace Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ $workspace->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                      rows="5">{{ $workspace->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="size" class="font-weight-bold">Size (m²)</label>
                                    <input type="number" class="form-control" id="size" name="size"
                                           value="{{ $workspace->size }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="people_capacity" class="font-weight-bold">Capacity</label>
                                    <input type="number" class="form-control" id="people_capacity"
                                           name="people_capacity" value="{{ $workspace->people_capacity }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Amenities</label>
                            <div class="row amenities-checkboxes">
                                @foreach ($amenities as $amenity)
                                <div class="col-md-3 mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="amenity{{ $amenity->id }}" name="amenities[]"
                                               value="{{ $amenity->id }}"
                                               {{ $workspace->amenities->contains($amenity->id) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="amenity{{ $amenity->id }}">
                                            <i class="{{ $amenity->icon }} mr-1"></i> {{ $amenity->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-primary next-step" data-next="2">
                                Next: Location <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Location Information -->
                <div class="card mb-4 shadow-sm form-step d-none" id="step-2">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt text-primary mr-2"></i>Location Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="governorate" class="font-weight-bold">Governorate</label>
                            <select class="form-control" id="governorate" name="governorate" required>
                                <option value="" disabled>Select Governorate</option>
                                <option value="Amman" {{ $workspace->governorate == 'Amman' ? 'selected' : '' }}>Amman</option>
                                <option value="Zarqa" {{ $workspace->governorate == 'Zarqa' ? 'selected' : '' }}>Zarqa</option>
                                <option value="Irbid" {{ $workspace->governorate == 'Irbid' ? 'selected' : '' }}>Irbid</option>
                                <option value="Aqaba" {{ $workspace->governorate == 'Aqaba' ? 'selected' : '' }}>Aqaba</option>
                                <option value="Mafraq" {{ $workspace->governorate == 'Mafraq' ? 'selected' : '' }}>Mafraq</option>
                                <option value="Balqa" {{ $workspace->governorate == 'Balqa' ? 'selected' : '' }}>Balqa</option>
                                <option value="Karak" {{ $workspace->governorate == 'Karak' ? 'selected' : '' }}>Karak</option>
                                <option value="Madaba" {{ $workspace->governorate == 'Madaba' ? 'selected' : '' }}>Madaba</option>
                                <option value="Tafilah" {{ $workspace->governorate == 'Tafilah' ? 'selected' : '' }}>Tafilah</option>
                                <option value="Jerash" {{ $workspace->governorate == 'Jerash' ? 'selected' : '' }}>Jerash</option>
                                <option value="Ajloun" {{ $workspace->governorate == 'Ajloun' ? 'selected' : '' }}>Ajloun</option>
                                <option value="Maan" {{ $workspace->governorate == 'Maan' ? 'selected' : '' }}>Maan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address" class="font-weight-bold">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ $workspace->address }}" required>
                            <small class="form-text text-muted">Please enter the exact address including street name and building number</small>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary prev-step" data-prev="1">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </button>
                            <button type="button" class="btn btn-primary next-step" data-next="3">
                                Next: Pricing <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Pricing Information -->
                <div class="card mb-4 shadow-sm form-step d-none" id="step-3">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-tags text-primary mr-2"></i>Pricing Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="type" class="font-weight-bold">Pricing Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="0" {{ $workspace->price_per_hour ? 'selected' : '' }}>Hourly</option>
                                <option value="1" {{ $workspace->price_per_month ? 'selected' : '' }}>Monthly</option>
                                <option value="2" {{ $workspace->price_per_day ? 'selected' : '' }}>Daily</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price" class="font-weight-bold">Price ($)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                @php
                                    $price = $workspace->price_per_hour ?? $workspace->price_per_day ?? $workspace->price_per_month;
                                @endphp
                                <input type="number" class="form-control" id="price" name="price"
                                       value="{{ $price }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary prev-step" data-prev="2">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </button>
                            <button type="button" class="btn btn-primary next-step" data-next="4">
                                Next: Media <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Media Upload -->
                <div class="card mb-4 shadow-sm form-step d-none" id="step-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-camera text-primary mr-2"></i>Media Upload</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Workspace Images</label>
                            <div class="row mb-3" id="current-images">
                                @if($workspace->images)
                                    @foreach(json_decode($workspace->images) as $image)
                                    <div class="col-md-3 mb-3">
                                        <img src="{{ asset('storage/'.$image) }}" class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                                        <button type="button" class="btn btn-sm btn-danger btn-block mt-2 remove-image" data-image="{{ $image }}">
                                            <i class="fas fa-trash mr-1"></i> Remove
                                        </button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="images"
                                       name="images[]" multiple accept="image/*">
                                <label class="custom-file-label" for="images">Choose files</label>
                            </div>
                            <small class="form-text text-muted">Upload high-quality images (max 5 images, 2MB each)</small>
                            <div class="image-preview mt-3" id="image-preview"></div>
                        </div>

                        <div class="form-group">
                            <label for="videolink" class="font-weight-bold">Video Link (Optional)</label>
                            <input type="url" class="form-control" id="videolink" name="video_link"
                                   value="{{ $workspace->video_url }}" placeholder="https://youtube.com/example">
                            <small class="form-text text-muted">Paste a YouTube or Vimeo link</small>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary prev-step" data-prev="3">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save mr-2"></i> Update Workspace
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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

    /* Form Steps */
    .form-steps .nav-link {
        padding: 12px;
        color: #6c757d;
        border-radius: 0;
        transition: all 0.3s;
    }

    .form-steps .nav-link.active {
        color: #3498db;
        background-color: rgba(52, 152, 219, 0.1);
        border-bottom: 3px solid #3498db;
    }

    .form-steps .nav-link.disabled {
        color: #adb5bd;
    }

    /* Form Steps Content */
    .form-step {
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }

    /* Image Preview */
    .image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .image-preview-item {
        position: relative;
        width: 120px;
        height: 90px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Amenities Checkboxes */
    .amenities-checkboxes {
        max-height: 200px;
        overflow-y: auto;
        padding: 10px;
        border: 1px solid #e9ecef;
        border-radius: 4px;
    }

    /* Custom File Input */
    .custom-file-label::after {
        content: "Browse";
    }

    /* Form Validation */
    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #dc3545;
    }

    .is-invalid ~ .invalid-feedback {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form steps
    const steps = document.querySelectorAll('.form-step');
    const stepLinks = document.querySelectorAll('.form-steps .nav-link');

    // Show first step by default
    steps[0].classList.remove('d-none');

    // Handle next step buttons
    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function() {
            const currentStep = this.closest('.form-step');
            const nextStepId = this.dataset.next;
            const nextStep = document.getElementById(`step-${nextStepId}`);

            // Validate current step before proceeding
            if (validateStep(currentStep.id)) {
                currentStep.classList.add('d-none');
                nextStep.classList.remove('d-none');

                // Update step indicator
                stepLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.dataset.step === nextStepId) {
                        link.classList.add('active');
                    } else if (parseInt(link.dataset.step) < parseInt(nextStepId)) {
                        link.classList.remove('disabled');
                    }
                });
            }
        });
    });

    // Handle previous step buttons
    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function() {
            const currentStep = this.closest('.form-step');
            const prevStepId = this.dataset.prev;
            const prevStep = document.getElementById(`step-${prevStepId}`);

            currentStep.classList.add('d-none');
            prevStep.classList.remove('d-none');

            // Update step indicator
            stepLinks.forEach(link => {
                link.classList.remove('active');
                if (link.dataset.step === prevStepId) {
                    link.classList.add('active');
                }
            });
        });
    });

    // Simple step validation
    function validateStep(stepId) {
        const step = document.getElementById(stepId);
        const inputs = step.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            const firstInvalid = step.querySelector('.is-invalid');
            firstInvalid.focus();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        return isValid;
    }

    // Image preview functionality
    document.getElementById('images').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('image-preview');
        previewContainer.innerHTML = '';

        if (this.files.length > 5) {
            alert('You can upload a maximum of 5 images');
            this.value = '';
            return;
        }

        Array.from(this.files).forEach((file, index) => {
            if (file.size > 2 * 1024 * 1024) {
                alert(`File ${file.name} is too large (max 2MB)`);
                return;
            }

            if (!file.type.match('image.*')) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'image-preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                `;
                previewContainer.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });
    });

    // Handle image removal
    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function() {
            const imagePath = this.dataset.image;
            const imageContainer = this.closest('.col-md-3');

            if (confirm('Are you sure you want to remove this image?')) {
                fetch('{{ route("lessor.workspaces.delete-image", $workspace->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        image: imagePath
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        imageContainer.remove();
                    } else {
                        alert('Error removing image');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the image');
                });
            }
        });
    });
});
</script>
@endpush
