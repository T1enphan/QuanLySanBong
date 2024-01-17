<?php

namespace App\Http\Requests\BaiViet;

use Illuminate\Foundation\Http\FormRequest;

class CreateBaiVietRequest extends FormRequest
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
            'tieu_de_bai_viet'             =>'required|min:5',
            'slug_bai_viet'                =>'required|min:5',
            'hinh_anh_bai_viet'            =>'required',
            'mo_ta_ngan_bai_viet'          =>'required|min:10',
            'mo_ta_chi_tiet_bai_viet'      =>'required|min:15',
            'the_loai'                     =>'required',
            'trang_thai'                   =>'required',
        ];
    }

    public function messages()
    {
        return [
            'tieu_de_bai_viet.*'             =>'Tiêu đề bài viết phải lớn hơn 5 kí tự!',
            'slug_bai_viet.*'                =>'Slug bài viết phải lớn hơn 5 kí tự!',
            'hinh_anh_bai_viet'              =>'Bạn cần thêm hình ảnh cho bài viết!',
            'mo_ta_ngan_bai_viet'            =>'Mô tả ngắn phải nhiều hơn 10 ký tự!',
            'mo_ta_chi_tiet_bai_viet'        =>'Mô tả chi tiết phải nhiều hơn 15 ký tự!',
            'the_loai'                       =>'Bạn cần thêm thể loại!',
            'trang_thai'                     =>'Bạn cần thêm tình trạng!',
        ];
    }
}
