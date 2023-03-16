<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class rate extends Model
{
    public $table = 'rate';

    public static function boot()
    {
        parent::boot();

        static::updated(function ($instance) {
           
            Cache::forget('comment'.$instance->product_id);
           
           
        });

        static::deleted(function ($instance) {
            Cache::forget('comment'.$instance->product_id);
           
        });

        static::created(function ($instance) {
            Cache::forget('comment'.$instance->product_id);
        });    
    }

    public $fillable = [
        'name',
        'email',
        'product_id',
        'star',
        'active',
        'content',
    ];    

    
}
