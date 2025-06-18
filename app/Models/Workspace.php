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
        'address', 'governorate', 'latitude', 'longitude',
        'price_per_hour', 'price_per_day', 'price_per_month',
        'minimum_term', 'minimum_term_unit', 'size', 'people_capacity',
        'space_type', 'status', 'rating', 'images', 'video_url'
    ];

    protected $casts = [
        'images' => 'array',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    protected $appends = [
        'image_url',
        'coordinates',
        'map_link',
        'average_rating',
        'reviews_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'workspace_amenity');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class)->with('user');
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

    public function getImageUrlAttribute()
    {
        if (empty($this->images)) {
            return asset('assets/images/default-image.jpg');
        }
        return asset('storage/' . ltrim($this->images[0], '/'));
    }

    public function getCoordinatesAttribute()
    {
        return [
            'lat' => $this->latitude,
            'lng' => $this->longitude
        ];
    }

    public function hasCoordinates()
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    public function getMapLinkAttribute()
    {
        if (!$this->hasCoordinates()) {
            return null;
        }
        return "https://www.openstreetmap.org/?mlat={$this->latitude}&mlon={$this->longitude}#map=15/{$this->latitude}/{$this->longitude}";
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getFullAddressAttribute()
    {
        $parts = [];
        if ($this->address) $parts[] = $this->address;
        if ($this->governorate) $parts[] = $this->governorate;
        if ($this->location) $parts[] = $this->location;

        return implode(', ', $parts);
    }

    public function avgRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function totalReviews()
    {
        return $this->reviews()->count();
    }
}
