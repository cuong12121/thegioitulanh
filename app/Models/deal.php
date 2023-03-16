<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class deal extends Model
{
     public $table = 'deal';

     public static function boot()
     {
          parent::boot();

          static::created(function ($instance) {
               // update cache content
               Cache::forget('deals');
               Cache::forever('deals',$instance->get());
          });

          static::updated(function ($instance) {
               // update cache content
               Cache::forget('deals');
               Cache::forever('deals',$instance->get());
               Cache::forget('deal_details'.$instance->product_id);
               Cache::forever('deal_details'.$instance->product_id,$instance);
          });

          static::deleted(function ($instance) {
               Cache::forget('deals');
               Cache::forever('deals',$instance->get());
               Cache::forget('deal_details'.$instance->product_id);
               Cache::forever('deal_details'.$instance->product_id,$instance);
          });
    }
}
