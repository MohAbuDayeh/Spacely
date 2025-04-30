<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workspace extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'description', 'location',
        'price_per_hour', 'price_per_day', 'price_per_month',
        'minimum_term', 'minimum_term_unit', 'size', 'people_capacity',
        'space_type', 'status'
    ];

    public function lessor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'workspace_amenity');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
