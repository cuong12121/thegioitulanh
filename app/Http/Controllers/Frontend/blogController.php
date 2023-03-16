<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use Cache;

class blogController extends Controller
{
    public function index()
    {
        
        $data = Cache::remember('data_blog',1000,function(){

            $data = post::select('title','content', 'id','category','image', 'link')->orderBy('date_post','desc')->paginate(10);

            return $data;
        });
        
      
        return view('frontend.blog',compact('data'));
    }
    
}
