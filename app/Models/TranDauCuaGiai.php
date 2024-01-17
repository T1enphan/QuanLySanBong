<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranDauCuaGiai extends Model
{
    use HasFactory;

    protected $table = 'tran_dau_cua_giais';

    protected $fillable = [
        'id_giai_dau',
        'id_doi_bong_giai_1',
        'id_doi_bong_giai_2',
        'id_hoa_don_thue_san',
    ];
}
