<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Support\Facades\Cache;

/**
 * Class image
 * @package App\Models
 * @version January 21, 2022, 7:54 am UTC
 *
 * @property string $image
 * @property string $link
 * @property string $product_id
 */
class image extends Model
{

    public $table = 'images';

    public static function boot()
    {
          parent::boot();

        static::created(function ($instance) {
           // update cache content
           Cache::forget('image_product'.$instance->product_id);
          
        });

        static::updated(function ($instance) {
           // update cache content
          
           Cache::forget('image_product'.$instance->product_id);
         


        });

        static::deleted(function ($instance) {
           Cache::forget('image_product'.$instance->product_id);
          
        });
    }   
    



    public $fillable = [
        'image',
        'link',
        'product_id',
        'order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'link' => 'string',
        'product_id' => 'string',
        'order' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
