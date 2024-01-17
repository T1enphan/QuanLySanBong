<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileClientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'         => 'required|min:3',
            'email'             => 'required|email|unique:khach_hangs,email,'. $this->id,
            'dia_chi'           => 'required|min:5',
            'so_dien_thoai'     => 'required|numeric',
            'password'          => 'min:3',
            're_password'       => 'min:3|same:password',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required'         => 'Họ và tên không được để trống!',
            'email.required'             => 'Email không được để trống!',
            'email.unique'               => 'Email đã tồn tại!',
            'dia_chi.required'           => 'Địa chỉ không được để trống!',
            'so_dien_thoai.required'     => 'Số điện thoại không được để trống!',
            'password.min'               => 'Mật khẩu phải nhập từ 3 kí tự!',
            're_password.same'           => 'Nhập lại mật khẩu không trùng khớp!',
        ];
    }
}
