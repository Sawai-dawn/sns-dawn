<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [ // タイムスタンプをCarbon インスタンスに
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // posts.user_id と users.id を自動的に紐付け
    }
}
