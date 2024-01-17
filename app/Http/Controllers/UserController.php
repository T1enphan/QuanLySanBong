<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\SendLienHeRequest;
use App\Http\Requests\Client\UpdateProfileClientRequest;
use App\Mail\SendLienHeMail;
use App\Models\BaiViet;
use App\Models\HoaDonThueSan;
use App\Models\KhachHang;
use App\Models\LoaiSan;
use App\Models\San;
use App\Models\TmpDatSan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function viewSchedule()
    {
        $sans = San::all();
        $week = Carbon::now()->startOfWeek()->format('d-m') . ' -> ' . Carbon::now()->endOfWeek()->format('d-m');
        // $data = LoaiSan::get();
        $sans = San::join('khu_vucs', 'sans.id_khu_vuc', 'khu_vucs.id')
                ->join('loai_sans', 'sans.id_loai_san', 'loai_sans.id')
                ->select('sans.*', 'khu_vucs.ten_khu_vuc', 'loai_sans.loai_san')
                ->orderBy('sans.id')
                ->get();
        $loaiSans = LoaiSan::where('tinh_trang', 1)->get();
        return view('user.page.datsan', compact('sans', 'week','loaiSans', 'sans'));
    }

    public function getPitchData()
    {
        $dsSan = San::join('hoa_don_thue_sans', 'hoa_don_thue_sans.id_san', 'sans.id')
                ->where('sans.tinh_trang', 1)
                ->whereBetween('hoa_don_thue_sans.ngay_thue_san', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->join('loai_sans', 'loai_sans.id', 'sans.id_loai_san')
                ->select('sans.*', 'hoa_don_thue_sans.tinh_trang as tinh_trang_thue', 'hoa_don_thue_sans.gio_ket_thuc', 'hoa_don_thue_sans.gio_bat_dau', 'hoa_don_thue_sans.ngay_thue_san', 'loai_sans.loai_san')
                ->get()->toArray();
        $avaiableTimeId = [
                "05" => "5to6",
                "06" => "6to7",
                "07" => "7to8",
                "08" => "8to9",
                "09" => "9to10",
                "10" =>"10to11",
                "11" =>"11to12",
                "12" =>"12to13",
                "13" => "13to14",
                "14" => "14to15",
                "15" => "15to16",
                "16" => "16to17",
                "17" => "17to18",
                "18" => "18to19",
                "19" => "19to20",
                "20" => "20to21"
            ];
        $dsSan = array_map(function($item) use ($avaiableTimeId) {
            $startString = Carbon::createFromFormat('H:i:s',$item['gio_bat_dau'])->format('H');
            $endString = Carbon::createFromFormat('H:i:s',$item['gio_ket_thuc'])->format('H');
            $day = Carbon::createFromFormat('Y-m-d',$item['ngay_thue_san'])->format('l');
            $timeId = $avaiableTimeId[$startString];
            $timeSpan = $endString - $startString;
            \Log::info($timeSpan);
            return array_merge($item, [
                'time_id' => $timeId,
                'time_span' => $timeSpan,
                'day' => strtolower($day),
            ]);
        }, $dsSan);
       $dsSan = collect($dsSan)->groupBy('slug_ten_san');
        return response()->json(['data' => $dsSan, 'message' => 'success'], Response::HTTP_OK);
    }
    public function getPitchs()
    {
        return response()->json(['data' => San::all(), 'message' => 'success'], Response::HTTP_OK);
    }

    public function baiViet()
    {
        return view('user.page.baiviet');
    }

    public function getBaiViet()
    {
        $data = BaiViet::get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function lienHe()
    {
        return view('user.page.contact');
    }

    public function SendlienHe(SendLienHeRequest $request)
    {
        $data = $request->all();
        $mailAdmin = 'vodinhquochuy1511@gmail.com';
        Mail::to($mailAdmin)->send(new SendLienHeMail($data));

        return response()->json([
            'status'    => 1,
            'message'   => 'Đã gửi liên hệ thành công!',
        ]);
    }

    public function viewProfileClient()
    {
        $user = Auth::guard('user')->user();
        return view('user.page.profileClient', compact('user'));
    }

    public function updateProfileClient(UpdateProfileClientRequest $request)
    {
        $user = Auth::guard('user')->user();
        $data = $request->all();
        $khachHang = KhachHang::find($user->id);
        if($khachHang){
            if(isset($data['password'])){
                $data['password'] = bcrypt($data['password']);
            }
            $khachHang->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật thông tin thành công!',
            ]);
        }


    }

    public function viewDanhSachSanDat()
    {
        return view('user.page.danhsachsandat');
    }

    public function dataDanhSachSanDat()
    {
        $user = Auth::guard('user')->user();
        $tmp = TmpDatSan::join('sans', 'sans.id', 'tmp_dat_sans.id_san')
                        ->where('id_khach_hang', $user->id)
                        ->select('tmp_dat_sans.*', 'sans.ten_san')
                        ->get();
        return response()->json([
            'data'    => $tmp,
        ]);
    }
}
