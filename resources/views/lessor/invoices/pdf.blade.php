<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>
    <h2>Invoice #{{ $payment->invoice_number }}</h2>
    <p><strong>Renter:</strong> {{ $payment->renter->name ?? 'N/A' }}</p>
    <p><strong>Amount:</strong> {{ $payment->amount }} JOD</p>
    <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
    <p><strong>Paid At:</strong> {{ $payment->paid_at ? $payment->paid_at->format('d M Y') : '-' }}</p>
</body>
</html>
