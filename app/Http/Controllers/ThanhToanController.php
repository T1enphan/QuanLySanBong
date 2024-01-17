<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    public function indexMomo()
    {
        return view('index_momo');
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function actionMomo(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = env('PARTNERCODE');
        $accessKey   = env("ACCESS_KEY");
        $secretKey   = env("SECRET_KEY");
        $orderInfo   = "Thanh toán qua MoMo";
        $amount      = $request->amount;
        $orderId     = time() ."";
        $returnUrl   = "http://127.0.0.1:8000/momo/ipn";
        $notifyurl   = "http://127.0.0.1:8000/momo/notifi";
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $extraData   = "merchantName=MoMo Partner";
        $requestId   = time() . "";
        $requestType = "captureMoMoWallet";
        // $bankCode    = "SML";

        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        dd($result);
        $jsonResult = json_decode($result, true);  // decode json
            dd($jsonResult);
        return redirect($jsonResult['payUrl']);
    }

    public function responeMomo(Request $request)
    {
        dd($request->all());
    }

    public function ipnMomo(Request $request)
    {
        dd($request->all());
    }
}
