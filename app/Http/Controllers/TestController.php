<?php

namespace App\Http\Controllers;

use App\Models\HoaDonThueSan;
use App\Models\TmpDatSan;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testss()
    {
        return view('admin.test');
    }

    public function checkDatSan()
    {
        $transaction = Transaction::get();
        $tmpDatSan = TmpDatSan::get();
        //chạy qua giao dịch ngân hàng
        foreach ($transaction as $key => $value) {
            //chạy qua các sân tạm đang đặt
            foreach ($tmpDatSan as $k => $v) {
                // điều kiên nội dung chuyển khoản và mã sân tạm đặt giống nhau
                //  và tiền chuyển khoản và tiền thực trả khi đặt giống nhau
                if($v->ma_thanh_toan == $value->noi_dung && $v->tong_tien_thanh_toan == $value->so_tien){
                    // khi đủ điều kiện thì sẽ tạo mới bên hóa đơn thuê sân với
                    $data['id_san'] = $v->id_san;
                    $data['id_khach_hang'] = $v->id_khach_hang;
                    $data['ngay_thue_san'] = $v->ngay_thue_san;
                    $data['gio_bat_dau'] = $v->gio_bat_dau;
                    $data['gio_ket_thuc'] = $v->gio_ket_thuc;
                    $data['so_tien'] = $v->so_tien;
                    $data['phan_tram_giam'] = $v->phan_tram_giam;
                    $data['tien_tra_truoc'] = $v->tong_tien_thanh_toan;
                    $data['tien_da_giam'] = $v->tong_tien_thanh_toan;
                    $data['tinh_trang'] = 3;
                    $data['is_thanh_toan'] = 1;
                    $hoaDonThueSan = HoaDonThueSan::create($data);
                }
            }
        }

    }

    public function transaction()
    {
        $client = new Client();
        $payload = [
            "USERNAME"      => "0936734440", // Tên đăng nhập
            "PASSWORD"      => "Congthach3010&", // Mật khẩu
            "DAY_BEGIN"     => Carbon::today()->format('d/m/Y'),
            // "DAY_BEGIN"     => '16/12/2023',
            // "DAY_END"       => '16/12/2023',
            "DAY_END"       => Carbon::today()->format('d/m/Y'),
            "NUMBER_MB"     => "0936734440" // Số Tài Khoản
        ];

        try {
            $response = $client->post('http://103.137.185.71:2603/mb', [
                'json' => $payload
            ]);

            $data = json_decode($response->getBody(), true);
            if($data['status'] == true) {
                foreach ($data['data'] as $key => $value) {
                    if($value['creditAmount'] > 0) {

                        $check      = Transaction::where('refNo', $value['refNo'])
                                                 ->first();
                        if(!$check) {
                            $date = Carbon::createFromFormat('d/m/Y H:i:s', $value['transactionDate']);
                            Transaction::create([
                                'accountNo'         => $value['accountNo'],
                                'transactionDate'   => $date,
                                'creditAmount'      => $value['creditAmount'],
                                'description'       => $value['description'],
                                'refNo'             => $value['refNo'],
                            ]);
                            $pattern = '/HDTT\d{6}/';
                            $text    = $value['description'];
                            if (preg_match($pattern, $text, $matches)) {
                                $result = $matches[0];
                                $tmpDatSan = TmpDatSan::where('ma_thanh_toan', $result)->first();
                                if($tmpDatSan){
                                    if($tmpDatSan->tong_tien_thanh_toan == $value['creditAmount']){
                                        $hoaDonThue = HoaDonThueSan::create([
                                            'id_san'                =>  $tmpDatSan->id_san,
                                            'id_khach_hang'         =>  $tmpDatSan->id_khach_hang,
                                            'ngay_thue_san'         =>  $tmpDatSan->ngay_thue_san,
                                            'gio_bat_dau'           =>  $tmpDatSan->gio_bat_dau,
                                            'gio_ket_thuc'          =>  $tmpDatSan->gio_ket_thuc,
                                            'so_tien'               =>  $tmpDatSan->so_tien,
                                            'phan_tram_giam'        =>  $tmpDatSan->phan_tram_giam,
                                            'tien_da_giam'          =>  $tmpDatSan->tong_tien_thanh_toan,
                                            'tien_tra_truoc'        =>  $tmpDatSan->tong_tien_thanh_toan,
                                            'tinh_trang'            =>  3,
                                            'is_thanh_toan'         =>  1
                                        ]);
                                        $tmpDatSan->is_thanh_toan = 1;
                                        $tmpDatSan->save();
                                    }
                                }
                            }
                        }
                    }
                }

                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false
                ]);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
    // public function test1()
    // {
    //     $hoaDonThue = HoaDonThueSan::where('tinh_trang', 1)->get();

    //     foreach($hoaDonThue as $key => $value){
    //         $thoi_gian_con_lai = strtotime($value->gio_ket_thuc) - strtotime($value->gio_bat_dau);
    //         $gio  = floor($thoi_gian_con_lai / 3600); // Số giờ
    //         $phut = floor(($thoi_gian_con_lai % 3600) / 60); // Số phút
    //         $giay = $thoi_gian_con_lai % 60;
    //         $thoi_gian = sprintf("%02d:%02d:%02d", $gio, $phut, $giay);
    //         dd($thoi_gian);
    //     }
    // }
}
