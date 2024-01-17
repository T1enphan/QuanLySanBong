<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSan extends Model
{
    use HasFactory;

    protected $table = 'loai_sans';

    protected $fillable = [
        'loai_san',
        'slug_loai_san',
        'tinh_trang',
    ];
}
