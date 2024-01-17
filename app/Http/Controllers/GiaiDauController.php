<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDoiBongGiaiDau;
use App\Models\GiaiDau;
use App\Models\TranDauCuaGiai;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class GiaiDauController extends Controller
{
    public function index()
    {
        return view('admin.page.giai_dau.index');
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $create = GiaiDau::create($data);
        if($create){
            for ($i=1; $i <= $data['so_doi']; $i++) {
                ChiTietDoiBongGiaiDau::create([
                    'id_giai_dau' => $create->id,
                ]);
            }
            for ($i=1; $i <= $data['so_tran']; $i++) {
                TranDauCuaGiai::create([
                    'id_giai_dau' => $create->id,
                ]);
            }
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã tạo giải đấu thành công!',
        ]);
    }

    public function getData()
    {
        $data = GiaiDau::get();

        return response()->json([
            'data'    => $data,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $giaiDau = GiaiDau::find($request->id);

        if($giaiDau){
            if($giaiDau->tinh_trang > 0){
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Giải đấu đang hoạt động, không thể cập nhật!',
                ]);
            }
            if(($data['so_doi'] - $giaiDau->so_doi) == 0){
                $giaiDau->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật giải đấu thành công!',
                ]);
            }else if(($data['so_doi'] - $giaiDau->so_doi) < 0){
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Hãy xóa đội trước khi cập nhật!',
                ]);
            }else{
                $so_luong_doi_can_them = $data['so_doi'] - $giaiDau->so_doi;
                for ($i=1; $i <= $so_luong_doi_can_them; $i++) {
                    ChiTietDoiBongGiaiDau::create([
                        'id_giai_dau' => $giaiDau->id,
                    ]);
                }
                $giaiDau->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật giải đấu thành công!',
                ]);
            }


        }
    }

    public function delete(Request $request)
    {
        $data = $request->all();

        $giaiDau = GiaiDau::find($data['id']);

        if($giaiDau){
            if($giaiDau->tinh_trang == 1){
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Giải đấu đang hoạt động, không thể xóa!',
                ]);
            }else{
                $id_giai_dau = $giaiDau->id;
                $status = $giaiDau->delete();
                if($status){
                    $chiTietDoiBong = ChiTietDoiBongGiaiDau::where('id_giai_dau', $id_giai_dau)->get();
                    foreach ($chiTietDoiBong as $key => $value) {
                        $value->delete();
                    }
                }
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa giải đấu thành công!',
                ]);
            }
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'Giải đấu không tồn tại!',
            ]);
        }
    }

    public function getDoiBongCuaGiai(Request $request)
    {
        $data = $request->all();

        $dsDoiBongCuaGiai = ChiTietDoiBongGiaiDau::where('id_giai_dau', $request->id)->get();

        return response()->json([
            'data'    => $dsDoiBongCuaGiai,
        ]);
    }

    public function updateDoiBongCuaGiai(Request $request)
    {
        $data = $request->all();
        $doiBong = ChiTietDoiBongGiaiDau::find($data['id']);

        if($doiBong){
            $doiBong->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật!',
            ]);
        }

    }

    public function deleteDoiBongCuaGiai(Request $request)
    {
        $data = $request->all();
        $giaiDau = GiaiDau::find($data['id_giai_dau']);
        if($giaiDau->tinh_trang > 0){
            return response()->json([
                'status'    => 0,
                'message'   => 'Giải đấu đang hoạt động hoặc đã kết thúc, không thể xóa đội!',
            ]);
        }else{
            $doiBong = ChiTietDoiBongGiaiDau::find($data['id']);
            if($doiBong){
                $delete = $doiBong->delete();
                if($delete){
                    if($giaiDau){
                        $giaiDau->so_doi = $giaiDau->so_doi - 1;
                        $giaiDau->save();
                    }
                }
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa thành công!',
                ]);
            }
        }
    }

    public function statusGiaiDau(Request $request)
    {
        $data = $request->all();
        $giaiDau = GiaiDau::find($data['id']);
        if($giaiDau){
            if($giaiDau->tinh_trang == 0){
                $giaiDau->tinh_trang = 1;
            }else if($giaiDau->tinh_trang == 1){
                $giaiDau->tinh_trang = 2;
            }else{
                $giaiDau->tinh_trang = 0;
            }
            $giaiDau->save();
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã đổi trạng thái giải đấu!',
            ]);
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'Giải đấu không tồn tại!',
            ]);
        }
    }

    public function chiTietGiai($id_giai_dau)
    {
        $giaiDau  = GiaiDau::find($id_giai_dau);
        $soDoi    = ChiTietDoiBongGiaiDau::where('id_giai_dau', $id_giai_dau)->get();
        $soTran   = TranDauCuaGiai::leftjoin('hoa_don_thue_sans', 'hoa_don_thue_sans.id', 'tran_dau_cua_giais.id_hoa_don_thue_san' )
                                    ->leftjoin('sans', 'sans.id', 'hoa_don_thue_sans.id_san')
                                    ->select('tran_dau_cua_giais.*', 'hoa_don_thue_sans.ngay_thue_san', 'sans.ten_san')
                                    ->where('tran_dau_cua_giais.id_giai_dau', $id_giai_dau)->get();
        $data = [];
        $dataChuaPush = [
            'ten_bang' => 'Bang 1',
            'list_doi' => [
                ['ten_doi_bong' => 'xxx'],
                ['ten_doi_bong' => 'ttt'],
                ['ten_doi_bong' => 'yyy']
            ]
        ];
        for ($i=1; $i <= $giaiDau->so_bang_dau; $i++) {
            $dataChuaPush['ten_bang'] = 'Bảng ' . $i;
            $list_doi = [];
            foreach ($soDoi as $key => $value) {
                if($value->bang_giai_dau == $i){
                    array_push($list_doi, $value);
                }
            }
            $dataChuaPush['list_doi'] = $list_doi;
            $list_doi = [];
            array_push($data, $dataChuaPush);
        }
        return view('admin.page.giai_dau.chi_tiet_giai_dau', compact('data', 'giaiDau', 'soTran', 'soDoi'));
    }

    public function chonDoiTranDauGiai(Request $request)
    {
        $data = $request->all();
        $tranDau = TranDauCuaGiai::find($data['id']);
        if($tranDau){
            if($data['id_doi_bong_giai_1'] != null){
                if($data['id_doi_bong_giai_1'] == $tranDau->id_doi_bong_giai_2){
                    return response()->json([
                        'status'    => 0,
                        'message'   => 'Đã trùng đội cùng trận đấu!',
                    ]);
                }
            }
            if($data['id_doi_bong_giai_2'] != null){
                if($data['id_doi_bong_giai_2'] == $tranDau->id_doi_bong_giai_1){
                    return response()->json([
                        'status'    => 0,
                        'message'   => 'Đã trùng đội cùng trận đấu',
                    ]);
                }
            }
            $tranDau->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Chọn Đội Thành Công!',
            ]);
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'Đã có lỗi xảy ra!',
            ]);
        }
    }
}
