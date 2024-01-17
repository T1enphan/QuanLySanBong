<?php

namespace App\Http\Requests\KhuVuc;

use Illuminate\Foundation\Http\FormRequest;

class DeleteKhuVuc extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id'    => 'exists:khu_vucs,id',
        ];
    }
    public function messages()
    {
        return [
            'id.*'   => 'Khu vực không tồn tại!',

        ];
    }
}
