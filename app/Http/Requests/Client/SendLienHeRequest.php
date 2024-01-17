<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class SendLienHeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'     => 'required|min:2',
            'email'         => 'required|email',
            'so_dien_thoai' => 'numeric',
            'noi_dung'      => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.*'               => 'Họ và tên phải từ 2 kí tự!',
            'email.required'            => 'Email không được để trống!',
            'so_dien_thoai.numeric'     => 'Số điện thoại phải là số!',
            'noi_dung.*'                => 'Nội dung phải từ 5 ký tự!'
        ];
    }
}
