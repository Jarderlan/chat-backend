<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicMessages extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'message'
    ];

    protected $appends = ['username'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsernameAttribute()
    {
        return $this->user()->value('name');
    }
}
