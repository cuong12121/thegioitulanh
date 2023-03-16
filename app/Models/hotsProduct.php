<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class hotsProduct extends Model
{
    public $table = 'hot_product';

    public static function boot()
    {
        parent::boot();

        static::created(function ($instance) {
            // update cache content
            Cache::forget('hots');
         
        });

        static::updated(function ($instance) {
           // update cache content
          
           Cache::forget('hots');
           
        });

        static::deleted(function ($instance) {
           
            Cache::forget('hots');
        });
    }
}
