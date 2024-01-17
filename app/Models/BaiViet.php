<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;

    protected $table = 'bai_viets';

    protected $fillable = [
        'tieu_de_bai_viet',
        'slug_bai_viet',
        'hinh_anh_bai_viet',
        'mo_ta_ngan_bai_viet',
        'mo_ta_chi_tiet_bai_viet',
        'the_loai',
        'trang_thai',
    ];
}
