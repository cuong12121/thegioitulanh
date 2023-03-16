<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;
use App\Models\groupProduct;
use Illuminate\Support\Facades\Cache;
use App\Models\deal;
use App\Models\product;
use Carbon\Carbon;
use Session;
use App\Models\filter;

use Auth;
use DB;



class indexController extends Controller
{
    public function index()
    {
       
        $banners =  Cache::get('baners');

        $now  = Carbon::now();

        if(!Cache::has('deals')){
            $deal = deal::get();

            Cache::forever('deals',$deal);

        }

        $deal = Cache::get('deals')->sortByDesc('order');

        $deal_check = deal::orderBy('end', 'desc')->get();

        $group = Cache::get('groups');

        $group = groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();

        

        $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->Orderby('sale_product.updated_at','desc')->get();

           
        

         $timeDeal_star = Cache::get('deal_start'); 


        if(!Cache::has('groups')||empty($product_sale) ){

            $this->cache();

            $deal = Cache::get('deals');

            $group = Cache::get('groups');

            $timeDeal_star = Cache::get('deal_start'); 

            $product_sale = Cache::get('product_sale');

        }

        if(!Cache::has('baners')){

            $banners =  Cache::rememberForever('baners', function() {

                return banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();
            });
        }    

        if(!Cache::has('bannersRights')){
            $bannersRight = Cache::rememberForever('bannersRights', function() {
                return banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
            });
        }
        else{
            $bannersRight = Cache::get('bannersRights');
        }

        if(!Cache::has('bannerUnderSlider')){
            $bannerUnderSlider = Cache::rememberForever('bannerUnderSlider', function() {
                return banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->get();
            });

        }
        else{
            $bannerUnderSlider = Cache::get('bannerUnderSlider');
        }

        if(!Cache::has('bannerUnderSale')){

            $bannerUnderSale = Cache::rememberForever('bannerUnderSale', function() {
                return banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();
            });
        }  
        else{
            $bannerUnderSale = Cache::get('bannerUnderSale');
        }

        $bannerscrollRight = Cache::rememberForever('bannerscrollRight', function() {
            return banners::where('option', 12)->OrderBy('stt', 'asc')->where('active', 1)->first()??'';
        });

        $bannerscrollLeft = Cache::rememberForever('bannerscrollleft', function() {
            return banners::where('option', 13)->OrderBy('stt', 'asc')->where('active', 1)->first()??'';
        });

        

        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal','product_sale', 'group','timeDeal_star', 'deal_check', 'now','bannerscrollRight', 'bannerscrollLeft'));
    }


    public function cache()
    {
        
        // $data = json_decode(filter::find(20)->value, true);

        // dd(1);

        $deal = deal::OrderBy('order', 'desc')->get();


        $groups = groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();

        if($deal->count()>0){

            $deal_start = $deal->first()->start;

            cache::put('deal_start', $deal_start,10000);

        }
        Cache::put('groups', $groups,10000);

    }

    public function cache1()
    {
        
        cache::forget('deal_start');

    
        Cache::forget('groups');

        Cache::forget('product_sale');
        
        Cache::forget('baners');

        $banners = banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();

        $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();

        $groups = groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();

        Cache::put('groups', $groups,10000);

        Cache::put('product_sale', $product_sale,10000);
        
        Cache::put('baners',$banners,10000);

        
    }

    public function deleteCache()
    {
        Cache::flush();
        echo "thanh cong";
    }

    public function showCart()
    {
        return view('frontend.cart');
    }

    public function addClick(Request $request)
    {
        $link = $request->link;

        $sessionKey = 'banner_click_'.$link;

        $sessionView = Session::get($sessionKey);

        $count = Cache::get('visited_banner_'.$link)??0;

        if (!$sessionView) { //nếu chưa có session

            Session::put($sessionKey, 1); //set giá trị cho session

            $count = Cache::increment('visited_banner_'.$link);   

        }

    }

    public function Cart()
    {
        return view('cart.cart');
    }

     
}