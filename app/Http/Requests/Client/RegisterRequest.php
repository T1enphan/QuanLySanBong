<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "ho_lot" => 'required|min:2',
            "ten" =>    'required|min:2',
            "email" =>  'required|email|unique:khach_hangs,email',
            "so_dien_thoai" =>  'required|numeric',
            "gioi_tinh" =>  'required',
            "password" =>   'required|min:4',
            "re_password" =>    'required|same:password',
            "dia_chi" =>    'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            "ho_lot.*" => 'Họ phải từ 2 ký tự trở lên!',
            "ten.*" =>    'Tên phải từ 2 ký tự trở lên!',
            "email.required" =>  'Email không được để trống!',
            "email.unique" =>  'Email đã tồn tại!',
            "so_dien_thoai.required" =>  'Số điện thoại không được để trống!',
            "so_dien_thoai.numeric" =>  'Số điện thoại phải nhập là số!',
            "gioi_tinh.*" =>  'Giới tính không được để trống!',
            "password.*" =>   'Mật khẩu không được để trống!',
            "re_password.required" =>  'Mật khẩu nhập lại không được để trống!',
            "re_password.same" =>  'Mật khẩu nhập lại không trùng!',
            "dia_chi.*" =>    'Địa chỉ không được để trống!',
        ];
    }
}
