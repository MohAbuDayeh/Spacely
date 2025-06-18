@extends('layouts.app')

@section('title', 'User Profile')
<link rel="stylesheet" href="{{ asset('assets\css\profile.css') }}">

@section('content')
<div class="profile-container">
    <div class="profile-content">
        <div class="profile-sidebar">
            <div class="profile-image">
                @if(Auth::user()->image)
                    <div class="image-container">
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture">
                        <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- <label for="file-upload" class="edit-pic">
                                <i class='bx bx-edit-alt'></i> Upload
                            </label> --}}
                            <input id="file-upload" type="file" name="image" accept="image/*" onchange="this.form.submit()" hidden>
                        </form>
                    </div>
                @endif
            </div>

            <div class="profile-details">
                <ul>
                    <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                    <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                    <li><strong>Member Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</li>
                    <li><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</li>
                </ul>
            </div>

            <div class="profile-actions">
                <a href="{{ route('user.profile', Auth::user()->id) }}" class="btn">Booking History</a>
                <a href="{{ route('user.profile.edit', ['id' => Auth::user()->id, 'ref' => 'personal']) }}" class="btn">Edit Profile</a>
                <a href="{{ route('user.profile.edit', ['id' => Auth::user()->id, 'ref' => 'pass']) }}" class="btn pass">Update Password</a>

                @if(Auth::user()->role === 'lessor')
                    <a href="{{ route('lessor.dashboard') }}" class="btn">Lessor Dashboard</a>
                @endif

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn">Admin Dashboard</a>
                @endif
            </div>
        </div>

        @yield('main')
    </div>
</div>
@endsection
