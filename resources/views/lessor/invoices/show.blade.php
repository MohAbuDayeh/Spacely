@extends('layouts.lessor')

@section('pageTitle', 'Invoice Details')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Invoice #{{ $payment->invoice_number }}</h4>
    </div>

    <div class="card-body">
        <p><strong>Renter:</strong> {{ $payment->renter->name ?? 'N/A' }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
        <p><strong>Status:</strong>
            @if($payment->status == 'paid')
                <span class="badge badge-success">Paid</span>
            @elseif($payment->status == 'pending')
                <span class="badge badge-warning">Pending</span>
            @else
                <span class="badge badge-danger">Failed</span>
            @endif
        </p>
        <p><strong>Amount:</strong> {{ $payment->amount }} JOD</p>
        <p><strong>Paid At:</strong> {{ $payment->paid_at ? $payment->paid_at->format('d M Y') : '-' }}</p>
        <p><strong>Booking ID:</strong> {{ $payment->booking_id }}</p>
    </div>

    <div class="card-footer text-right">
        <a href="{{ route('lessor.invoices.download', $payment->id) }}" class="btn btn-outline-secondary">Download PDF</a>
        <a href="{{ route('lessor.invoices.index') }}" class="btn btn-secondary">Back to Invoices</a>
    </div>
</div>
@endsection
