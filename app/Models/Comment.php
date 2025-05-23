<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mading_id',
        'content',
        'image_ids'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mading()
    {
        return $this->belongsTo(Mading::class);
    }
}
