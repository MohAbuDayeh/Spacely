<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'workspace_id', 'comment', 'rating', 'response'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
