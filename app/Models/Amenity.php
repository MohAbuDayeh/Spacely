<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amenity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class, 'workspace_amenity');
    }
}
