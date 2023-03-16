<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class newProduct extends Model
{
     public $table = 'new_product';

      public static function boot()
    {
        parent::boot();

        static::created(function ($instance) {
            // update cache content
            Cache::forget('new_product');
         
        });

        static::updated(function ($instance) {
           // update cache content
          
           Cache::forget('new_product');
           
        });

        static::deleted(function ($instance) {
           
            Cache::forget('new_product');
        });
     }    
}
