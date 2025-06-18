@extends('layouts.userProfile')

@section('main')
<div class="profile-main-content">
    <h3>Booking History</h3>

    @if($bookings->isEmpty())
        <div class="no-bookings">
            <p>You don't have any bookings yet.</p>
            <a href="{{ route('renter.workspaces.index') }}" class="btn btn-primary">Book a Workspace</a>
        </div>
    @else
        <div class="bookings-list">
            @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="booking-image">
                    @php
                        $workspaceImages = json_decode($booking->workspace->images, true);
                        $imageUrl = isset($workspaceImages[0]) ? asset('storage/' . $workspaceImages[0]) : asset('assets/images/default-workspace.jpg');
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $booking->workspace->title }}">
                </div>

                <div class="booking-details">
                    <h4>{{ $booking->workspace->title }}</h4>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $booking->workspace->location }}</p>

                    <div class="booking-info">
                        <div>
                            <span>Date:</span>
                            <strong>{{ $booking->start_date->format('M d, Y') }}</strong>
                        </div>
                        <div>
                            <span>Time:</span>
                            <strong>{{ $booking->start_time->format('h:i A') }} - {{ $booking->end_time->format('h:i A') }}</strong>
                        </div>
                        <div>
                            <span>Status:</span>
                            <span class="status-badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                        </div>
                    </div>
                </div>

                <div class="booking-actions">
                    <a href="{{ route('renter.bookings.show', $booking->id) }}" class="btn btn-outline">View Details</a>
                    @if($booking->status === 'upcoming')
                        <a href="#" class="btn btn-danger">Cancel Booking</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
