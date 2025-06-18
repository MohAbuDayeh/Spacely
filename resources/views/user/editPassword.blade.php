@extends('layouts.userProfile')

@section('main')
<div class="profile-main-content">
    <h3>Update Password</h3>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.profile.update', Auth::user()->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-4">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" id="current_password" name="current_password"
                   class="form-control @error('current_password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('current_password')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="password" class="form-label">New Password</label>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
            <small class="form-text text-muted mt-1">
                Password must be at least 8 characters long
            </small>
        </div>

        <div class="form-group mb-4">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-actions d-flex justify-content-between align-items-center mt-5">
            <button type="submit" class="btn btn-primary px-4 py-2">
                <i class="fas fa-key me-2"></i> Update Password
            </button>
            <a href="{{ route('user.profile', $user->id) }}" class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>

<style>
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .btn {
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>

<script>
    // Dynamic password strength indicator (optional)
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthIndicator = document.createElement('div');
        strengthIndicator.className = 'password-strength mt-2';

        // Remove previous indicator if exists
        const existingIndicator = this.parentNode.querySelector('.password-strength');
        if (existingIndicator) {
            existingIndicator.remove();
        }

        if (password.length > 0) {
            let strength = 'Weak';
            let color = 'text-danger';

            if (password.length >= 12) {
                strength = 'Very Strong';
                color = 'text-success';
            } else if (password.length >= 8) {
                strength = 'Strong';
                color = 'text-info';
            } else if (password.length >= 6) {
                strength = 'Medium';
                color = 'text-warning';
            }

            strengthIndicator.innerHTML = `
                <small class="${color}">
                    <i class="fas fa-lock me-1"></i> Strength: ${strength}
                </small>
            `;
            this.parentNode.appendChild(strengthIndicator);
        }
    });
</script>
@endsection
