<?php

namespace App\Http\Requests\San;

use App\Models\HoaDonThueSan;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMoSanRealRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $now = Carbon::today();
        return [
            "id_san" => 'required|exists:sans,id',
            "gio_bat_dau" => [
                'required',
                function ($attribute, $value, $fail) use ($now) {
                    $sanOrdereds = HoaDonThueSan::where('tinh_trang', '!=', 2)
                    ->where('id_san', $this->id_san)
                    ->where('ngay_thue_san', $now)
                    ->where([
                        ['gio_bat_dau', "<=", $value],
                        ['gio_ket_thuc', ">", $value]
                    ])
                    ->get()
                    ->count();

                    if ($sanOrdereds != 0) {
                        return $fail('Sân đang hoạt động vào khung giờ này');
                    }
                }
            ],
            "gio_ket_thuc" => [
                'required',
                function ($attribute, $value, $fail) use ($now) {
                    $greater = HoaDonThueSan::where('tinh_trang', '!=', 2)
                    ->where('id_san', $this->id_san)
                    ->where('ngay_thue_san', $now)
                    ->where([
                        ['gio_bat_dau', "<", $value],
                        ['gio_ket_thuc', ">=", $value]
                    ])
                    ->get()
                    ->count();
                    if ($greater != 0) {
                        return $fail('Sân đang hoạt động vào khung giờ này');
                    }
                }
            ],
            "so_tien" => 'required|numeric|min:0',
            "id_khach_hang" => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            "id_san.required" => 'Sân bắt buộc phải chọn!',
            "id_san.exists" => 'Sân không tồn tại!',
            "gio_bat_dau.required" => 'Giờ bắt đầu bắt buộc phải chọn!',
            "gio_ket_thuc.required" => 'Giờ kết thúc bắt buộc phải chọn!',
            "so_tien.required" => 'Số tiền không được để trống!',
            "so_tien.numeric" => 'Số tiền phải là số!',
            "so_tien.min" => 'Số tiền phải lớn hơn 0!',
        ];
    }

}
