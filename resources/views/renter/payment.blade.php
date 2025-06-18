@extends('layouts.app')

@section('title', "Payment")

@section("content")
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2>Confirm Your Booking</h2>
        <div class="card-logos">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard" class="mr-3" style="width: 100px;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa" style="width: 100px;">
        </div>
    </div>

    <p id="errorMessage" class="error text-danger text-center"></p>
    <p id="successMessage" class="success text-success text-center"></p>

    <div class="booking-details mb-4 p-3 bg-light rounded shadow-sm">
        <h4 class="text-primary">Booking Details</h4>
        <p><strong>Workspace:</strong> {{ $booking->workspace->title }}</p>
        <p><strong>Location:</strong> {{ $booking->workspace->location }}</p>
        <p><strong>Booking Date:</strong> {{ $booking->start_time->format('d M, Y') }} to {{ $booking->end_time->format('d M, Y') }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
    </div>

    <!-- Payment Form -->
    <form id="paymentForm" method="POST" action="{{ route('payment.store') }}" onsubmit="return handleSubmit(event)">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

        <div class="form-group">
            <label for="name">Name on Card</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
            <p class="error text-danger" id="nameErr"></p>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="expiry">Expiry Date</label>
                <input type="text" name="expiry" id="expiry" class="form-control" placeholder="MM/YY" required>
                <p class="error text-danger" id="exErr"></p>
            </div>
            <div class="col-md-6">
                <label for="cvv">CVV</label>
                <input type="password" name="cvv" id="cvv" class="form-control" maxlength="3" placeholder="123" required>
                <p class="error text-danger" id="cvvErr"></p>
            </div>
        </div>

        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="tel" name="cardNumber" id="cardNumber" class="form-control" maxlength="19" placeholder="1111 2222 3333 4444" required>
            <p class="error text-danger" id="cardErr"></p>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block">Complete Payment</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Add form validation if needed
        async function handleSubmit(event) {
        event.preventDefault(); // Prevent form from submitting

        const name = document.getElementById('name').value.trim();
        const expiry = document.getElementById('expiry').value.trim();
        const cvv = document.getElementById('cvv').value.trim();
        const cardNumber = document.getElementById('cardNumber').value.trim();

        // Clear previous messages
        document.getElementById('errorMessage').innerText = '';
        if (!name || !expiry || !cvv || !cardNumber) {
            document.getElementById('errorMessage').innerText = 'All fields are required!';
            return false;
        }

        // You can add extra validation here (expiry format, card number, etc.)

        const result = await Swal.fire({
            title: "Payment Successful",
            text: "Your payment has been processed successfully!",
            icon: "success",
            confirmButtonText: "OK"
        });

        if (result.isConfirmed) {
            // Submit the form after confirmation
            document.getElementById('paymentForm').submit();
        }

        return false;
    }
</script>
@endsection
