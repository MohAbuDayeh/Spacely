<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_method',
        'amount',
        'status',
        'lessor_id',
        'renter_id',
        'invoice_number',
        'paid_at',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function lessor()
    {
        return $this->belongsTo(User::class, 'lessor_id');
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }
}
