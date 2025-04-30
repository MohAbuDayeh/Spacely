<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone'];

    protected $hidden = ['password'];

    public function workspaces()
    {
        return $this->hasMany(Workspace::class); // المؤجر
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class); // المستأجر
    }

    public function favorites()
    {
        return $this->belongsToMany(Workspace::class, 'favorites');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
