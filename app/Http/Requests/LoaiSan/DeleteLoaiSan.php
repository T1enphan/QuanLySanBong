<?php

namespace App\Http\Requests\LoaiSan;

use Illuminate\Foundation\Http\FormRequest;

class DeleteLoaiSan extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id'    => 'exists:loai_sans,id',
        ];
    }
    public function messages()
    {
        return [
            'id.*'   => 'Loại sân không tồn tại!',

        ];
    }
}
