<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        return view('admin.page.log.index');
    }

    public function data()
    {
        $data = Log::join('admins', 'admins.id', 'logs.id_nguoi_log')
                    ->select('logs.*', 'admins.ho_va_ten')
                    ->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
