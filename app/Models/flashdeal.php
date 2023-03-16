<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

use Illuminate\Support\Facades\Cache;

class flashdeal extends Model
{
    public $table = 'deal_flash_product';

    public static function boot()
    {
        parent::boot();

        static::updated(function ($instance) {
            
            Cache::forget('date_flash_deal');

            $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;

            Cache::forever('date_flash_deal',$date_string_flash_deal);
           
        });

        static::deleted(function ($instance) {
            
            Cache::forget('date_flash_deal');

            $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;

            Cache::forever('date_flash_deal',$date_string_flash_deal);
        });

        static::created(function ($instance) {

            Cache::forget('date_flash_deal');

            $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;

            Cache::forever('date_flash_deal',$date_string_flash_deal);
        });    
    }
}
