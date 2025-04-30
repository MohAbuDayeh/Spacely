<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'workspace_id', 'start_time', 'end_time', 'total_price', 'status'
    ];

    public function renter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
