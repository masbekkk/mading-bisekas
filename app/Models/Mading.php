<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'work_location',
        'type_of_work',
        'status',
        'tanggal',
        'pic',
        'status_color',
        'status_pending',
        'need_approve',
        'approved',
        'rejected',
        'document',
    ];

    const STATUS_TAGIHAN_DP = 'Tagihan DP';
    const STATUS_TIME_SCHEDULE = 'Time Schedule';
    const STATUS_FPP = 'FPP';
    const STATUS_PENGADAAN = 'Pengadaan';
    const STATUS_PENGIRIMAN = 'Pengiriman';
    const STATUS_RUNNING = 'Running';
    const STATUS_RETURN_BST = 'Return & BST';
    const STATUS_FINISH = 'Finish';
    const STATUS_INVOICE = 'Invoice';
    const STATUS_LUNAS = 'Lunas';
    const STATUS_KOMPLAIN = 'Komplain';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
