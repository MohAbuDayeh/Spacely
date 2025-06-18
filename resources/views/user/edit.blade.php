@extends('layouts.userProfile')

@section('main')
<div class="profile-main-content">
    <h3>Edit Profile Information</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Profile Picture Section -->
        <div class="form-group mb-4">
            <label class="d-block">Profile Picture</label>
            <div class="d-flex align-items-center">
                <div class="profile-image-edit mr-4">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}"
                             id="image-preview"
                             alt="Profile Picture"
                             class="rounded-circle"
                             width="100"
                             height="100">
                    @else
                        <div class="avatar-default rounded-circle d-flex align-items-center justify-content-center bg-light"
                             style="width: 100px; height: 100px;">
                            <span class="display-4 text-muted">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                           id="profile_image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Upload a square image (JPEG, PNG, JPG, GIF) max 2MB
                    </small>
                    @if($user->image)
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('remove_image').value = '1'; document.getElementById('image-preview').src = '#';">
                                Remove Current Photo
                            </button>
                            <input type="hidden" name="remove_image" id="remove_image" value="0">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $user->phone) }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="company">Company (Optional)</label>
            <input type="text" id="company" name="company" class="form-control @error('company') is-invalid @enderror"
                   value="{{ old('company', $user->company) }}">
            @error('company')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Save Changes
            </button>
            <a href="{{ route('user.profile', $user->id) }}" class="btn btn-outline-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>

<style>
    .profile-main-content {
        padding: 2rem;
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
    }
    .profile-image-edit img {
        object-fit: cover;
        border: 3px solid #f0f0f0;
    }

    .avatar-default {
        border: 3px solid #f0f0f0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
    }

    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
    }
</style>

<script>
    // Preview image before upload
    document.getElementById('profile_image').addEventListener('change', function(e) {
        const preview = document.querySelector('#image-preview');
        const defaultAvatar = document.querySelector('.avatar-default');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (preview) {
                    preview.src = e.target.result;
                } else if (defaultAvatar) {
                    defaultAvatar.innerHTML = `<img src="${e.target.result}" class="rounded-circle" width="100" height="100">`;
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
