<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\apiUpdate;
use Illuminate\Support\Facades\Cache;

class apiController extends Controller
{
    public function updateProduct(Request $request, $slug)
    {
        $product = product::where('ProductSku', $slug)->first();

        if(!empty($product)&& !empty($product->id)){

            if(!isset($request->Quantily)||!isset($request->Price)){
                 return response()->json([
                'message' => 'param truyền bị lỗi, xin kiểm tra lại'], 404);

            }

            $id = $product->id;

            $product = product::find($id);

            $priceOld = $product->Price;

            $qty_old  = $product->Quantily;

            $product->Price =  $request->Price;

            $product->Quantily = $request->Quantily;

            $result = $product->save();


            $apiUdate = new apiUpdate();

            $apiUdate->model = $slug;

            $apiUdate->qty  = $request->Quantily;

            $apiUdate->price_old = $priceOld;

            $apiUdate->qty_old = $qty_old;

            $apiUdate->price_new = $request->Price;

            $apiUdate->user = $request->User;

            $update_soft = $apiUdate->save();


            if($result && $update_soft){

                return response()->json([
                'message' => 'update sản phẩm thành công!'], 200);
            }
            else{
                return response()->json([
                'message' => 'có lỗi trong quá trình update, xin kiểm tra lại'], 404);
            }

        }
        else{

            return response()->json([
                'message' => 'Model sản phẩm không đúng, xin kiểm tra lại'], 404);
        }

    }

    public function checkDeal()
    {
        Cache::forget('product_search');

        $productss = product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku')->where('active', 1)->get();

        Cache::forever('product_search',$productss);

        $data =  Cache::get('product_search');

        $search = 'Máy giặt LG ';

        $collection = collect($data)->filter(function ($item) use ($search) {
            return false !== strpos($item->ProductSku, $search);
        });

        if($collection->count()==0){

            $collection = collect($data)->filter(function ($item) use ($search) {
                return false !== strpos($item->Name, $search);
            });

            $collection = $collection->take(6)->sortByDesc('id');
        }

      
        dd($collection);
    }
}
