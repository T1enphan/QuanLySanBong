<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class San extends Model
{
    use HasFactory;

    protected $table = 'sans';
    protected $fillable = [
        'ten_san',
        'slug_ten_san',
        'id_khu_vuc',
        'id_loai_san',
        'tinh_trang',
        'tien_goc',
    ];
}
