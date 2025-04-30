<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'workspace_id', 'amount', 'status','availability_date',
    ];

    // علاقة مع المستخدم (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة مع المساحة (Workspace)
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
