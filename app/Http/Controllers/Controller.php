<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\PhanQuyen;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function createLog($id_nguoi_tao, $noi_dung, $type)
    {
        Log::create([
            'id_nguoi_log' => $id_nguoi_tao,
            'noi_dung' => $noi_dung,
            'type' => $type
        ]);
    }

    public function sendTele($noi_dung)
    {
        $url = 'https://api.telegram.org/bot6458445725:AAGbdN3wghCfqx6Hgm4pjv4gRB7JPg8NflI/sendMessage?chat_id=1386450617&text=' . $noi_dung;
        $client = new Client();
        $response = $client->get($url);
    }

    public function checkRule_get($id)
    {
        $admin       = Auth::guard('admin')->user();
        $groupAdmin = PhanQuyen::find($admin->id_quyen);
        if($groupAdmin->is_master){
            return true;
        }
        if($groupAdmin) {
            $listRule    = explode(',', $groupAdmin->list_rule);
            return in_array($id, $listRule);
        } else {
            return false;
        }
    }

    public function checkRule_post($id)
    {
        $admin       = Auth::guard('admin')->user();
        $groupAdmin  = PhanQuyen::find($admin->id_quyen);
        if($groupAdmin->is_master){
            return true;
        }
        if($groupAdmin) {
            $listRule    = explode(',', $groupAdmin->list_rule);
            return in_array($id, $listRule);
        } else {
            return false;
        }
    }
}
