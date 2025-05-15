<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_SURVEY = 'SURVEY';
    const STATUS_MINTA_PENAWARAN = 'MINTA PENAWARAN';
    const STATUS_PENAWARAN = 'PENAWARAN';
    const STATUS_TAGIHAN_PELUNASAN_DP = 'TAGIHAN DP';
    const STATUS_FPP = 'FPP';
    const STATUS_JSA = 'JSA';
    const STATUS_TIME_SCHEDULE = 'TIME SCHEDULE';
    const STATUS_PENGADAAN = 'PENGADAAN';
    const STATUS_SURAT_JALAN = 'SURAT JALAN';
    const STATUS_PENGIRIMAN = 'PENGIRIMAN';
    const STATUS_RUNNING_MC_0 = 'RUNNING MC-0';
    const STATUS_RUNNING_MC_25 = 'RUNNING MC-25';
    const STATUS_RUNNING_MC_50 = 'RUNNING MC-50';
    const STATUS_RUNNING_MC_75 = 'RUNNING MC-75';
    const STATUS_RUNNING_MC_100 = 'RUNNING MC-100';
    const STATUS_RETUR = 'RETUR';
    const STATUS_BAST = 'BAST';
    const STATUS_TAGIHAN_PELUNASAN = 'TAGIHAN PELUNASAN';
    const STATUS_KOMPLAIN = 'KOMPLAIN';
    const STATUS_LUNAS = 'LUNAS';
    const STATUS_FINISH = 'FINISH';

    const NEED_APPROVAL_STATUSES = [
        self::STATUS_PENAWARAN,
        self::STATUS_FPP,
        self::STATUS_TIME_SCHEDULE,
        self::STATUS_KOMPLAIN
    ];

    const NEED_UPLOAD_DOCUMENT_STATUSES = [
        self::STATUS_MINTA_PENAWARAN,
        self::STATUS_PENAWARAN,
        self::STATUS_TAGIHAN_PELUNASAN_DP,
        self::STATUS_FPP,
        self::STATUS_JSA,
        self::STATUS_TIME_SCHEDULE,
        self::STATUS_SURAT_JALAN,
        self::STATUS_RETUR,
        self::STATUS_BAST,
        self::STATUS_TAGIHAN_PELUNASAN,
    ];

    const NEED_UPLOAD_IMAGES_STATUSES = [
        self::STATUS_RUNNING_MC_0,
        self::STATUS_RUNNING_MC_25,
        self::STATUS_RUNNING_MC_50,
        self::STATUS_RUNNING_MC_75,
        self::STATUS_RUNNING_MC_100,
        self::STATUS_KOMPLAIN,
    ];

    public static function getStatusList()
    {
        return [
            self::STATUS_SURVEY,
            self::STATUS_MINTA_PENAWARAN,
            self::STATUS_PENAWARAN,
            self::STATUS_TAGIHAN_PELUNASAN_DP,
            self::STATUS_FPP,
            self::STATUS_JSA,
            self::STATUS_TIME_SCHEDULE,
            self::STATUS_PENGADAAN,
            self::STATUS_SURAT_JALAN,
            self::STATUS_PENGIRIMAN,
            self::STATUS_RUNNING_MC_0,
            self::STATUS_RUNNING_MC_25,
            self::STATUS_RUNNING_MC_50,
            self::STATUS_RUNNING_MC_75,
            self::STATUS_RUNNING_MC_100,
            self::STATUS_RETUR,
            self::STATUS_BAST,
            self::STATUS_TAGIHAN_PELUNASAN,
            self::STATUS_KOMPLAIN,
            self::STATUS_LUNAS,
            self::STATUS_FINISH
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function getProjectOwnerAttribute()
    {
        return $this->user_id ? ($this->user->name ?? null) : $this->attributes['project_owner'];
    }
}
