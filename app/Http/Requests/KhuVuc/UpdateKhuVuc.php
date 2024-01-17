<?php

namespace App\Http\Requests\KhuVuc;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKhuVuc extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                    =>  'required|exists:khu_vucs,id',
            'ten_khu_vuc'           =>  'required',
            'slug_khu_vuc'          =>  'required|unique:khu_vucs,slug_khu_vuc,'. $this->id,
            'tinh_trang'            =>  'required',

        ];
    }

    public function messages()
    {
        return [
            'id.*'                   =>  'Khu vực không tồn tại!',
            'ten_khu_vuc.required'   =>  'Yêu cầu phải nhập tên khu!',
            'slug_khu_vuc.required'  =>  'Yêu cầu phải nhập slug khu!',
            'slug_khu_vuc.unique'    =>  'Khu vực đã tồn tại!',
            'tinh_trang.required'    =>  'Yêu cầu phải nhập tình trạng!',
        ];
    }
}
