<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\post;

use App\Models\groupProduct;

use App\Models\product;

class sitemapController extends Controller
{
   public function index()
   {
    
        return response()->view('sitemap.index')->header('Content-Type', 'text/xml');

   }

   public function brand()
   {
        $data        = groupProduct::where('parent_id', 35)->get();

        return response()->view('sitemap.brand', [
            'data' => $data,
        ])->header('Content-Type', 'text/xml');
   }

   public function sitemapChildProduct()
   {

    $data        = groupProduct::find(3);

    $product_tl  = json_decode($data->product_id);


    $product   =  product::whereIn('id',  $product_tl)->orderBy('id', 'desc')->take(80)->get();

   

       return response()->view('sitemap.child', [
            'product' => $product,
        ])->header('Content-Type', 'text/xml');
   }
   public function sitemapChildBlog()
   {
    $blog = post::take(160)->OrderBy('id', 'desc')->get();

    
       return response()->view('sitemap.childs_blog', [
            'blog' => $blog
        ])->header('Content-Type', 'text/xml');
   }
   



}

