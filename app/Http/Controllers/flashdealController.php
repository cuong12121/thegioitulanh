<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;

use App\Models\flashdeal;

use DB; 

use Carbon\Carbon;

use App\Models\deal;

class flashdealController extends Controller
{
    public function GetProductbyId(request $request)
    {
        $ar_product = json_decode($request->data);

        $edit_id   = $request->edit_id;

        $timeDeal  = $request->id_time;
       
        $ar_products_id = [];

        $product_id = $request->id_product;

        $check_deal  = deal::where('product_id', $product_id)->where('active', 1)->first();

        if(!empty($check_deal)){

            return '1';

        }

       
        foreach($ar_product as $val){

            array_push($ar_products_id, $val->id);
        }
        
        $products   =  product::select('Name', 'Link', 'Price','id', 'Image')->whereIN('id', $ar_products_id)->get()->toArray();

        $products_add = [];

        if(isset($products)){

           for ($i=0; $i < count($products) ; $i++) { 

                $products[$i]['price_deal'] = $ar_product[$i]->price_deal;

                $products_add['name'] = $products[$i]['Name'];
                $products_add['image'] = $products[$i]['Image'];
                $products_add['link'] = $products[$i]['Link'];
                $products_add['price'] = $products[$i]['Price'];
                $products_add['deal_price'] = str_replace([',','.'],'',$products[$i]['price_deal']);

                $products_add['product_id'] = $products[$i]['id'];
                $products_add['flash_deal_id'] = $timeDeal;  

                $time = DB::table('deal_flash_product')->select('start', 'end')->first();

                if(!empty($time)){
                    $products_add['start'] = $time->start;

                    $products_add['end'] = $time->end;
                }  
                else{
                    $products_add['start'] ='';

                     $products_add['end'] ='';

                } 


                if(empty($edit_id)){
                    $insert = DB::table('deal_flash_product')->insert($products_add);
                }
                else{

                   $insert = DB::table('deal_flash_product')->where('id', $edit_id)->update($products_add);
                }
           }
        }
        return  $product_id;
    }
    public function dealOrder(Request $request)
    {
        $id = $request->product_id;
        $val = $request->val;
        if(!empty($val)){
            $deal = flashdeal::find($id);
            $deal->order = $val;
            $deal->save();

        }
        return response('thanh cong');
    }

    public function editFlashDealPrice(Request $request)
    {
        $id = $request->product_id;
        $val = $request->val;
        $val = str_replace(['.',','],'', $request->val);
        if(!empty($val)){
            $deal = flashdeal::find($id);
            $deal->deal_price = trim($val);
            $deal->save();

        }
        return response('thanh cong');
    }


    public function removeDeal(Request $request)
    {
       $id = $request->id;

        DB::table('deal_flash_product')->delete($id);

    }

    public function addDealFlash(Request $request)
    {
        $id = $request->id;
        $val = $request->val;
        $deal = flashdeal::find($id);
        $deal->flash_deal_time_id = $val;
        $result = $deal->save();
    }

    public function addTimeDealBefore(Request $request)
    {
        $date = DB::table('date_flash_deal')->where('id', 1)->first();

        $time =  Carbon::createFromDate($date->date)->addDay();

        DB::table('date_flash_deal')->where('id', 1)->update(['date' => $time->format('d-m-Y')]);

        $flashdeal = flashdeal::get();

        foreach ($flashdeal as $key => $value) {

            $flashdeals = flashdeal::find($value->id);

            $flashdeals->flash_deal_time_id = $value->flash_deal_time_id_demo;

            $flashdeals->save();
        }

        echo "thành công";

    }

    public function addDealFlashDemo(Request $request)
    {
        $id = $request->id;
        $val = $request->val;
        $deal = flashdeal::find($id);
        $deal->flash_deal_time_id_demo = $val;
        $result = $deal->save();
    }

    public function activeDeal(Request $request){

        $id = $request->id;

        $active = $request->active;

        $deal = flashdeal::find($id);

        if($active == 1){

            $deal->active = 0;

        }
        else{
            $deal->active = 1;
        }

        $deal->save();
    }
    public function getProductToName(Request  $request)
    {
        $data = $request->data;

        $page = $request->page;

        $datas = new mainController();

        $products = $datas->findProductByNameOrModel($data);

       
        return view('frontend.ajax.viewer-click-product', compact('products'));
         

    }

    public function updateTimeFlashDeal(Request $request)
    {
        $time = $request->time;
        $data = DB::table('date_flash_deal')->where('id', 1)->update(['date' => $time]);
    }

     public function showDealByIdClick(Request $request)
    {
        $page = $request->page??'';


        $id = $request->product_id;
        $flashDealId = $request->flash_deal_id;
        $keyss = $request->key;
        $flashDealInfo = DB::table('flash_deal')->where('id', $flashDealId)->first();
        $price = $flashDealInfo->price;
        $checksoon = $request->checksoon;

        if($page ==='index'){
           $deal = flashdeal::where('flash_deal_id', $flashDealId)->where('flash_deal_time_id', $id)->where('active',1)->OrderBy('order','desc')->take(4)->get();
        }
        else{
            $deal = flashdeal::where('flash_deal_id', $flashDealId)->where('flash_deal_time_id', $id)->where('active',1)->orderBy('order', 'desc')->get();

        }

       
        return view('frontend.ajax.dealClick', compact('deal', 'id', 'keyss', 'price','checksoon'));

    }
}
