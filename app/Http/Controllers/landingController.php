<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;

use App\Models\landing;

use DB;

class landingController extends Controller
{
    public function addLanding(Request $request){



        $data = json_decode($request->data);

        $action = $request->action;

        if($action == 'add'){
            $products   =  product::select('Name', 'Link', 'Price','id', 'Image', 'ProductSku', 'Quantily')->whereIN('id', $data)->get()->toArray();
            if(isset($products)){
                foreach($products as $value){
                    $input['name'] = $value['Name'];
                    $input['link'] = $value['Link'];

                    $input['price'] = $value['Price'];

                    $input['product_id'] = $value['id'];

                    $input['image'] = $value['Image'];

                    $input['model'] = $value['ProductSku'];

                    $input['qualtily'] = $value['Quantily'];

                    DB::table('landing_product')->insert($input);

                }

                
            }
        }
        else{

            $id_edit = $request->id_edit;

           

            $products   =  product::select('Name', 'Link', 'Price','id', 'Image', 'ProductSku', 'Quantily')->whereIN('id', $data)->get()->toArray();

            if(isset($products)){

                foreach($products as $value){

                    $input['name'] = $value['Name'];
                    $input['link'] = $value['Link'];

                    $input['price'] = $value['Price'];

                    $input['product_id'] = $value['id'];

                    $input['image'] = $value['Image'];

                    $input['model'] = $value['ProductSku'];

                    $input['qualtily'] = $value['Quantily'];

                    $update = DB::table('landing_product')->where('id', $id_edit)->update($input);

                    echo "update thanh cong";

                }   
            }
            else{
             echo "update thất bại";
            }

        }    
        
    }

    public function add_Hight_Light(Request $request)
    {
        $id = $request->id;
        $hight_light = landing::find($id);

        $hight_light_check = landing::where('hight_light', 1)->OrderBy('id','desc')->get();

      
        if(count($hight_light_check)>=2){

            $hight_light_remove = landing::find($hight_light_check[0]->id);

            $hight_light_remove->hight_light = 0;

            $hight_light_remove->save();

        }

        $hight_light->hight_light = 1;

        $hight_light->save();


    }

    public function removeLanding(Request $request)
    {
       $id = $request->id;

        DB::table('landing_product')->delete($id);

    }
}
