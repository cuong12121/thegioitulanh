<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;
use DB;
use App\Models\groupProduct;

use App\Models\deal;

use Carbon\Carbon;

use Illuminate\Support\Facades\Cache;

class dealController extends Controller
{
    public function index()
    {
        return view('deal.deals');

    }

    public function getTimeDeal(Request $request)
    {
        $id = $request->product_id;
        $data = deal::find($id);
        $ar = [$data->start, $data->end];
        return $ar;
    }
    public function flashDeal()
    {
        return view('flash_deal.deals');
    }

    public function dealShowFlash()
    {
        return view('frontend.landingsDeal');
    }

    public function getProductToGroupId(request $request){

        $groupid = $request->group_id;

        $groupProduct = groupProduct::find($groupid);

        $ar_product  = json_decode($groupProduct->product_id);    

        $products = product::select('Name', 'Link', 'Price','id')->whereIn('id', $ar_product)->where('active', 1)->Orderby('id', 'desc')->paginate(20);
        return view('frontend.ajax.option_product', compact('products'));

    }


    public function getProductToName(Request  $request)
    {
        $data = $request->data;

        $page = $request->page;

        $datas = new mainController();

        $products = $datas->findProductByNameOrModel($data);

        if($page =='deal'){

            return view('frontend.ajax.option_product', compact('products'));
        }
        else{
            return view('frontend.ajax.product_landing', compact('products'));
        }    

    }

    public function GetProductbyId(request $request)
    {
        $ar_product = json_decode($request->data);

        $edit_id   = $request->edit_id;

       
        $ar_products_id = [];

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
                $products_add['created_at'] = Carbon::now();
                $products_add['updated_at'] = Carbon::now();

                $time = DB::table('deal')->select('start', 'end')->first();

                if(!empty($time)){
                    $products_add['start'] = $time->start;

                    $products_add['end'] = $time->end;
                }  
                else{
                    $products_add['start'] ='';

                     $products_add['end'] ='';

                }  
              
                if(empty($edit_id)){
                     DB::table('deal')->insert($products_add);
                }
                else{

                    DB::table('deal')->where('id', $edit_id)->update($products_add);
                }
               
           }
        }
        return  $products_add;

    }

    public function updateTimeDeal(Request $request)
    {
        $start = $request->start;

        $end  = $request->end;

        $id  = $request->id;

        $deal = deal::find($id);

        $deal->start = $start;

        $deal->end = $end;

        $deal->save();

    }

    public function add_Deal(Request $request)
    {
        $start = $request->start;

        $end  = $request->end;

        $deal = DB::table('deal')->select('id')->get();


        if(isset($deal)){

            foreach($deal as $value){

                $add_deal = deal::find($value->id);

                $add_deal->start = $start;

                $add_deal->end = $end;

                $add_deal->save();


            }    
        }


    }

    public function dealOrder(Request $request)
    {
        $id = $request->product_id;
        $val = $request->val;
        if(!empty($val)){
            $deal = deal::find($id);
            $deal->order = $val;
            $deal->save();

        }
        return response('thanh cong');
    }

     public function editDealPrice(Request $request)
    {
        $id = $request->product_id;
        $val = $request->val;
        $val = str_replace(['.',','],'', $request->val);
        if(!empty($val)){
            $deal = deal::find($id);
            $deal->deal_price = trim($val);
            $deal->save();

        }
        return response('thanh cong');
    }

    public function activeDeal(Request $request){

        $id = $request->id;

        $active = $request->active;

        $deal = deal::find($id);

        if($active == 1){

            $deal->active = 0;

        }
        else{
            $deal->active = 1;
        }

        $deal->save();
    }

   
    public function removeDeal(Request $request)
    {
       $id = $request->id;

        DB::table('deal')->delete($id);

    }

    public function showDealByIdClick(Request $request)
    {
        $id = $request->product_id;
        $deal = Cache::get('deals')->where('flash_deal', $id)->sortByDesc('order');

        return view('frontend.ajax.dealClick', compact('deal', 'id'));

    }

    public function addDealFlashs(Request $request)
    {
        $name = $request->name;

        $price =  str_replace(',', '', $request->price);

        $price =  str_replace('.', '', $price);

        $data  = ['name'=>$name, 'price'=>$price];
       
        DB::table('flash_deal')->insert($data);

        echo "Thành công!";

    }

    public function showDealEdits(Request $request)
    {
        $id = $request->deal_id;
    
        $data = DB::table('flash_deal')->where('id', $id)->get()->first();

        if(!empty($data)){

            return view('flash_deal.popup_deal',compact('data'));
        }
    
    }

    public function updateFlashDealToId(Request $request)
    {
        $id   = $request->id;
        $name = $request->name;
        $price= $request->price;
        $data = DB::table('flash_deal')->where('id', $id)->get()->first();

        if(!empty($data)){

            $datas  = ['name'=>$name, 'price'=>$price];

            DB::table('flash_deal')->where('id', $id)->update($datas);
        }
          
    }

    public function removeDealFlash(Request $request)
    {
        $id   = $request->id;

        $data = DB::table('flash_deal')->where('id', $id)->get()->first();

        if(!empty($data)){

            DB::table('flash_deal')->delete($id);
        }
    }

    public function viewFlashDeal()
    {
        return view('flash_deal.flash_deal_list');
    }
}
