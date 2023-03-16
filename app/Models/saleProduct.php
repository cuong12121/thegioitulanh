<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class saleProduct extends Model
{
    public $table = 'sale_product';

    public static function boot()
    {
        parent::boot();

        static::updated(function ($instance) {
            // update cache content
            Cache::forget('product_sale');
        });

        static::deleted(function ($instance) {
            // delete post cache
            Cache::forget('product_sale');
        });

        static::created(function ($instance) {
            Cache::forget('product_sale');
           
        });    
    }
}
