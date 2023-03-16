<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alepay;

use App\Models\installment;

class payController extends Controller
{

    protected function payAlepay(Request $request)
    {
        require(public_path().'/lib_pay/alepay-v3/config.php');

        $data = $request->all();

        $data['orderDescription'] = $data['product_name']. '. *Số tiền thanh toán trước trả góp là: '. $data['before_money'].'đ'.' với số lượng là'.$data['totalItem'].' sản phẩm'  ;

        $data['currency'] ='VND';

        $data['cancelUrl'] = URL_DEMO;

        $data_price =  session('priceProduct');

        // xóa session luôn

        // $request->session()->forget('priceProduct');

        $data_price = str_replace('.', '', $data_price);

        $data_pre_price   = str_replace('.', '',$data['before_money']);

        $data_all_price  = (intval($data_price) - intval($data_pre_price))*intval($data['totalItem']);

        $data['amount'] = $data_all_price;




        $data['orderCode'] = date('dmY') . '_' . uniqid();


        $data['totalItem'] = intval($data['totalItem']);

        $data['customMerchantId'] = trim($data['buyerName']);

        $data['checkoutType'] = 2;

        $data['allowDomestic'] = false;

        $data['installment'] = false; 

        $data['paymentHours'] = 48;

        $data['buyerPhone'] = trim($data['phoneNumber']);

        $data['buyerCountry'] = 'Việt Nam';

        $installment = new installment();

        $installment->price = $data['amount'];

        $installment->pre_price = $data['before_money'];

        $installment->email = $data['buyerEmail'];

        $installment->name = $data['buyerName'];

        $installment->phone = $data['phoneNumber'];

        $installment->address = $data['buyerAddress'];

        $installment->qualtity = 1;

        $installment->city = $data['buyerCity'];

        $installment->product_id  = $data['product_id'];

        $installment->save();

        $result = new Alepay($config);

        $result = $result->sendOrderV3($data);
        
        
        if (!empty($result->code)) {
            if ($result->code == '000') {
                echo '<meta http-equiv="refresh" content="0;url=' . $result->checkoutUrl . '">';
            } else {
                echo '<p style="text-align: center; margin-top: 15px;"><b>Response:</b> ' . json_encode($result, JSON_UNESCAPED_UNICODE) . '</p>';
            }
        }

    }
}
