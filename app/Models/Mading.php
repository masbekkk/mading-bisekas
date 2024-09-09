<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_owner',
        'work_location',
        'type_of_work',
        'status',
        'tanggal',
        'pic',
        'status_color',
    ];
}
