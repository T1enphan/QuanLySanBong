<?php

namespace App\Http\Requests\LoaiSan;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoaiSan extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'loai_san'              =>  'required',
            'slug_loai_san'         =>  'required|unique:loai_sans,slug_loai_san',
            'tinh_trang'            =>  'required',

        ];
    }

    public function messages()
    {
        return [
            'loai_san.required'       =>  'Yêu cầu phải nhập loại sân!',
            'slug_loai_san.required'  =>  'Yêu cầu phải nhập slug loại sân!',
            'slug_loai_san.unique'    =>  'Loại sân đã tồn tại!',
            'tinh_trang.required'     =>  'Yêu cầu phải nhập tình trạng!',
        ];
    }
}
