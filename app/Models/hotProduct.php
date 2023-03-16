<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class hotProduct extends Model
{
    public $table = 'hot';

    public static function boot()
    {
        parent::boot();

        static::created(function ($instance) {
            // update cache content
            Cache::forget('hot'.$instance->group_id);
            Cache::forget('data'.$instance->group_id);
        });

        static::updated(function ($instance) {
           // update cache content
            Cache::forget('hot'.$instance->group_id);
            Cache::forget('data'.$instance->group_id);
           
        });

        static::deleted(function ($instance) {
            Cache::forget('hot'.$instance->group_id);
            Cache::forget('data'.$instance->group_id);
        });
    }
}
