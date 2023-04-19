<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\product;

use App\Models\image;

use App\Models\groupProduct;

use App\Models\filter;
use App\Models\post;

use App\Models\category;

use App\Models\metaSeo;

 use Illuminate\Support\Facades\Cache;


use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Frontend\filterController;

use App\Models\redirectLink;


use Session;



class categoryController extends Controller
{


    public function categoryView($slug)
    {


        if(!empty($_GET['filter'])){

            $link     = !empty($_GET['link'])?strip_tags($_GET['link']):'';

            $group_id =  !empty($_GET['group_id'])?strip_tags($_GET['group_id']):'';

            $filter =   !empty($_GET['filter'])?explode(',', $_GET['filter']):'' ;

            $property = !empty($_GET['property'])?explode(',', $_GET['property']):'';


            $new_filter = [];

            $new_property = [];

            if(!empty($filter)){
                foreach($filter as $value){
                    array_push($new_filter, strip_tags($value));
                }
            }

            if(!empty($property)){
                foreach($property as $values){
                    array_push($new_property, strip_tags($values));
                }
            }
             $findID = groupProduct::where('link', $link)->first();


            if(!empty($findID)){

                $id_cate = $findID->id;
                $groupProduct_level = $findID->level;
                $ar_list = $this->find_List_Id_Group($id_cate,$groupProduct_level);

                // check sản phẩm là nhóm gia dụng

                if($ar_list[0]['id']==8 && $groupProduct_level==2){
                    $ar_list[0]['id'] = $id_cate;
                }

                $parent_cate_id = $ar_list[0]['id'];

                $list_data_group = filter::where('group_product_id', $parent_cate_id)->whereIn('id', $filter)->select('value')->get()->toArray();


                if($parent_cate_id == 8){

                    $parent_cate_id = $id_cate;
                }

                $filter = filter::where('group_product_id', $parent_cate_id)->select('name', 'id')->get();

                $fill = [];

                $keys =  [];

                $result = [];

                $product = [];

                $product_search = [];


                $checkidgroup = groupProduct::find($group_id);



                if(!empty($checkidgroup) && !empty($checkidgroup->product_id)){

                    $checkidgroup_id = json_decode($checkidgroup->product_id);
            
                    if(!empty($list_data_group[0]['value'])){


                        foreach ($list_data_group as $key => $value) {
                            foreach($value as $values){

                                $arr = json_decode($values, true);

                                if(isset($arr)){

                                    array_push($fill, $arr);

                                    $keys[] = array_keys($arr);
                                }
                            }

                        }
                        
                        if(isset($keys)){
                            foreach($keys as $key1 => $vals){

                           
                                foreach($vals as $valu){

                                    if(in_array($valu, $property)){

                                        $result[] = $fill[$key1][$valu];
                                    }
                                
                                }

                            }
                            
                            if(isset($result)){

                                foreach ($result as  $res) {
                                    foreach($res as $res1){
                                        $product[] = $res1;
                                    }
                                }
                            }

                            $number_key = count($keys);

                            $number_product    = array_count_values($product);
                        
                            if(isset($number_product)){
                                $result_product = [];
                                foreach ($number_product as $key => $value) {
                                    if($value == $number_key){
                                        array_push($result_product, $key);
                                    }

                                }

                                $product_search = product::whereIn('id', $result_product)->whereIn('id', $checkidgroup_id)->where('active', 1)->get();
                            }

                        }
                    }

                }

                else{
                     $product_search =[];
                    $id_cate ='';
                    $ar_list =[];
                    $groupProduct_level = 0;

                }

            }
            else{
                $product_search =[];
                $id_cate ='';
                $ar_list =[];
                $groupProduct_level = 0;

            }

             return view('frontend.filter', compact('product_search', 'link', 'filter', 'id_cate', 'ar_list', 'groupProduct_level'));

        }
        else{
            $data = $this->getDataOfCate($slug);
            return view('frontend.category', with($data));
        }
       
    }



    public function getDataOfCate($slug)
    {

        $link = trim($slug);

        $findID = cache()->remember('findID_link_group'.$link, 100, function () use($link){

            $findID = groupProduct::where('link', $link)->first()??'';

            return $findID;
        });


        if(empty($findID)){
            return $this->blogDetailView($slug);
        }
        else{

            if(!empty($_GET['filter'])){
                $data = new filterController();


                $data = $data->filter();

            }
           
            $id_cate = $findID->id;

            $groupProduct_level = $findID->level;

            $ar_list = $this->find_List_Id_Group($id_cate,$groupProduct_level);

            $parent_cate_id = $ar_list[0]['id'];

            $parent_id_cate = $ar_list[0]['id'];


            $link   =  $findID->link;


            $Group_product = cache()->remember('groupProduct_cate_child__'.$id_cate, 1000, function () use($id_cate){
                $Group_product = groupProduct::find($id_cate)??'';

                return  $Group_product;

            });

            

            $slogan =  $Group_product->slogan;

            $meta = cache()->remember('meta_id_'.$Group_product->Meta_id, 1000, function () use($Group_product){

                $meta = metaSeo::find($Group_product->Meta_id)??'';

                return $meta;
            });

            

            $data =[];

            $numberdata = 0;

            if(!empty($Group_product) && !empty($Group_product->product_id)){

                $Group_product_active = $Group_product->active;

                $data = [];

                if($Group_product_active==1){

                    $Group_product = json_decode($Group_product->product_id);

                    $page = !empty($_GET['page'])?$_GET['page']:1;

                   
                    $limit = 12;

                   
                    $data = cache()->remember('data_'.$id_cate.'_'.$page, 100, function () use($Group_product, $limit, $page){

                        $data = product::whereIn('id', $Group_product)->where('active', 1)->orderBy('id', 'desc')->limit($limit)->offset(($page - 1) * $limit)->get();

                        return $data;

                    });  
                        
                
                    $numberdata = cache()->remember('numberdata'.$id_cate, 100, function () use($Group_product){

                        $numberdata = product::select('id')->whereIn('id', $Group_product)->where('active', 1)->orderBy('Quantily', 'desc')->get()->count()??0;

                        return $numberdata;

                    });    

                
                }

            }

            if($parent_cate_id == 8){

                $parent_cate_id = $id_cate;

            }

           $filter =  cache()->remember('group_product_id__'.$parent_cate_id, 1000, function () use($parent_cate_id){

                $filter = filter::where('group_product_id', $parent_cate_id)->select('name', 'id')->get()??'';

                return $filter;
                
            });
            
           
            $name_cate = (groupProduct::find($id_cate))->name;
            

            $data = [
                'data'=>$data,
                'filter'=>$filter,
                'id_cate'=>$id_cate,
                'name_cate'=>$name_cate,
                'link'=>$link,
                'ar_list'=>$ar_list,
                'slogan'=>$slogan,
                'meta'=> $meta,
                'numberdata'=>$numberdata,
                'groupProduct_level'=>$groupProduct_level,
                'parent_id_cate'=>$parent_id_cate,
                'page'=>$page??1,

            ];


            return $data;
        }    

    }

    public function filterBycheckbox(Request $request)
    {
        $datas = $request->datas;

        $id   = $request->id;

        $filter = filter::find($id);

        $data = json_decode($filter['value'],true);

        $data_pd = $data[$datas];


        

        // $data_pd = [];

        // if(count($data)>0){

        //     foreach ($data as $key => $value) {

        //         $products = groupProduct::find($value);

        //         if(!empty($products) && !empty($products->product_id)){

        //             $ar_pd =  json_decode($products->product_id);

        //             if(count($ar_pd)){

        //                 foreach ($ar_pd as  $value) {

        //                     array_push($data_pd, $value);

        //                 }

        //             }
                   
        //         }

                
        //     }               
        // }

        

        $product = product::whereIn('id', $data_pd)->get();

        return view('frontend.ajax.filter_click', compact('product'));
        
    }    


    protected function find_List_Id_Group($id,  $groupProduct_level)
    {

        $list = cache()->remember('list_group_pr_'.$id, 1000, function () use($id){
             $list =  groupProduct::find($id)??'';
             return $list;
        });
       

        $ar_list = [];

        if(isset($list)){

            if((int)$groupProduct_level>0){

                for ($i=0; $i < $groupProduct_level; $i++) { 

                    $list_add = $list->parent_id;

                
                    $list = cache()->remember('list_cache_'.$id, 1000, function () use($list_add){

                        $list =  groupProduct::find($list_add)??'';

                        return $list;
                    });

                    array_push($ar_list, $list_add);
                   
                    
                }

            }
           
        }

        $ar_list[] = $id;

        $info_list_category = [];

        $groupProduct_info = cache()->remember('groupProduct_info_'.$id, 1000, function ()  use($ar_list){

             $groupProduct_info = groupProduct::select('name','link','id')->whereIn('id', $ar_list)->get()->toArray()??[];

            return $groupProduct_info;
        });

        

        return $groupProduct_info;
    }


    public function test()
    {
        $data = filter::find(20);

        $data = json_decode($data['value'],true);

        dd($data[50]);
    }

   

    public function blogDetailView($slug)
    {
        $link = trim($slug);

        $data = post::where('link', $link)->first();

        if(empty($data)){
            return $this->categoriesBlog($slug);

            die();

            
        }

        $category = category::find($data->category);


        $related_news = post::where('category', $data->category)->where('active', 1)->select('title', 'link', 'id')->get();

        $name_cate = $category->namecategory;


        $meta = metaSeo::find($data->Meta_id);

        // đếm số lượt view

        // $sessionKey = 'post_' . $data->id;

        // $sessionView = Session::get($sessionKey);

        // $post_view = DB::table('posts')->where('id', $data->id);

        // if (!$sessionView) { //nếu chưa có session

        //     Session::put($sessionKey, 1); //set giá trị cho session

        //     $post_view->increment('views', 1);

        // }


        echo view('frontend.blogdetail',compact( 'name_cate', 'related_news', 'meta', 'data'));

        die();
    }

    public function categoriesBlog($slug)
    {
        $link = trim($slug);

        $datas = category::where('link', $link)->first();

     
        if(empty($datas)){
            abort('404');
        }
        $name_cates_cate = '';
        
        if($datas->id!=5){

             $name_cates_cate = $datas->namecategory;

        }

        $data = post::where('category', $datas->id)->orderBy('date_post','desc')->orderBy('date_post','desc')->paginate(10);

      
        echo view('frontend.blog', compact('data','name_cates_cate'));

        die();



    }


    public function pageView($slug)
    {
        $link = trim($slug);

        $data = post::where('link', $link)->where('category', 5)->first();

        if(empty($data)){
            abort('404');
        }

        $category = category::find(5);


        $related_news = post::where('category', 5)->select('title', 'link', 'id')->get();

        $name_cate = $category->namecategory;

        $meta = metaSeo::find($data->Meta_id);

        return view('frontend.blogdetail',compact( 'name_cate', 'related_news', 'meta', 'data'));

    }
    public function index($slug)
    {
        
       return redirect(route('details', $slug));
    }


    public function get_Group_Product($id){

        $data_groupProduct = groupProduct::where('level', 0)->get()->pluck('id');

        $infoProductOfGroup = groupProduct::select('product_id', 'id')->whereIn('id', $data_groupProduct)->get()->toArray();

        $result = [];
    

        if(isset($infoProductOfGroup)){

            foreach($infoProductOfGroup as $key => $val){


                if(!empty($val['product_id'])&& in_array($id, json_decode($val['product_id']))){



                    array_push($result, $val['id']);
                }
               
            }

        }

        return $result;
    }    

    public function details($slug)
    {
        $slug = trim($slug);

        $link = trim($slug);


        $link_redirect = redirectLink::where('request_path', '/'.$slug)->first();


        if(!empty($link_redirect)){

    
            return redirect($link_redirect->target_path, 301);

            die();
        }


        $cache = 'findID'.$link;

        $findID = Cache::rememberForever($cache, function() use ($link) {

            $findID = product::select('id')->where('Link', $link)->first()??'';
            return  $findID;
        });


        // $findID = product::where('Link', $link)->first();
        
        // chuyển sang category check

        if(empty($findID)){

            return($this->categoryView($slug));

        }

        else{

            $pageCheck = "product";

            $images = Cache::get('image_product'.$findID->id);



            if(!Cache::has('image_product'.$findID->id)){
                
                $image_cache = image::where('product_id', $findID->id)->select('image')->get();

                Cache::forever('image_product'.$findID->id,$image_cache);
            }

            if(!empty($_GET['cache'])){

                $image_cache = image::where('product_id', $findID->id)->select('image')->get();

                Cache::forget('image_product'.$findID->id);

                Cache::forever('image_product'.$findID->id,$image_cache);
            }

            $data = Cache::rememberForever('data-detail'.$slug, function() use($slug) {

                return product::where('Link',$slug)->first();
            });

            // kiểm tra link cache có tồn tại hay k

            

            if(empty($data)){
                return abort('404');
            }

            // end kiem tra check cẩn thận

            // dd($data->Meta_id);

            //end check cache

            if(!empty($data) && !empty($_GET['show'])&&($_GET['show']=='tra-gop')){
                
                return view('frontend.installment', compact('data'));
            }

            if(!empty($data->LinkRedirect)){

                return redirect($data->LinkRedirect, 301); 
            }

            $group_product = Cache::rememberForever('group_product_cache_'.$findID->id, function() use ($findID){

                $group_products = $this->get_Group_Product($findID->id)??0;

                return $group_products;
            });

           
            $data_cate = 1;


            if(!empty($group_product && $group_product[0])){

                $data_cate = $group_product[0];

            } 


              


            $data_group_product = Cache::rememberForever('data_group_product_'.$data_cate, function() use ($data_cate){ 

                $data_group_products = groupProduct::find($data_cate);

                return $data_group_products;
            });  

            $other_product = Cache::rememberForever('other_product_'.$data_group_product->product_id, function() use ($data_group_product){ 

                return product::whereIn('id',  json_decode($data_group_product->product_id))->take(10)->get();
            });  
            


            $meta = Cache::remember('metaseo-detail'.$data->Meta_id,100, function() use ($data){
                return metaSeo::find($data->Meta_id);
            }); 
            
            return view('frontend.details', compact('data', 'images', 'other_product', 'meta', 'pageCheck', 'data_cate'));
        }
    }

    public function addProductToCart()
    {

        Cart::add(['id' => '294ad', 'name' => 'Smart tivi Samsung UA50AU9000 50 inch 4K', 'qty' => 1, 'price' => '5000.000', 'weight' => '500', 'options' => ['size' => 'large']]);
        $cart =  Cart::content();

    }

}
