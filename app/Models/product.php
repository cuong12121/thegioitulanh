<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Support\Facades\Cache;

use HepplerDotNet\FullTextSearch\FullTextSearch;

/**
 * Class product
 * @package App\Models
 * @version January 19, 2022, 4:54 am UTC
 *
 * @property string $Image
 * @property string $Product
 * @property string $ProductSku
 * @property string $Link
 * @property string $Detail
 * @property string $Salient_Features
 * @property string $Specifications
 * @property integer $Quantily
 * @property string $Maker
 * @property string $Group
 */
class product extends Model
{

    use FullTextSearch;

    public $table = 'products';

    public static function boot()
    {
        parent::boot();

        static::updated(function ($instance) {
            // update cache content
            Cache::forget('data-detail'.$instance->slug);
            Cache::forever('data-detail'.$instance->Link,$instance);
            Cache::forget('product_search');
            $productss = product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku', 'manuPrice', 'orders_hot')->where('active', 1)->get();
            Cache::forever('product_search',$productss);
           
        });

        static::deleted(function ($instance) {
            // delete post cache
            Cache::forget('data-detail'.$instance->Link);
            Cache::forget('product_search');
            $productss = product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku','manuPrice', 'orders_hot')->where('active', 1)->get();
            Cache::forever('product_search',$productss);
        });

        static::created(function ($instance) {
            Cache::forget('product_search');
            $productss = product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku','manuPrice', 'orders_hot')->where('active', 1)->get();
            Cache::forever('product_search',$productss);
        });    
    }
    
    public $fillable = [
        'Image',
        'Name',
        'ProductSku',
        'manuPrice',
        'Link',
        'Detail',
        'Salient_Features',
        'Specifications',
        'Quantily',
        'Maker',
        'Group_id',
        'Price',
        'Meta_id',
        'promotion',
        'limits',
        'GiftPrice',
        'LinkRedirect',
        

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Image' => 'string',
        'Name' => 'string',
        'ProductSku' => 'string',
        'Link' => 'string',
        'Quantily' => 'integer',
        'Maker' => 'string',
        'Group_id' => 'string',
        'Price' => 'integer',
        'InputPrice'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'Name' => 'required|unique:products|max:1000',
        'ProductSku' => 'required|unique:products',
        'Price' => 'required',
    ];

    public static $rule = [
        'Image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        // 'Name' => 'required|max:1000',
        // 'ProductSku' => 'required',
        // 'Specifications' => 'required',
        // 'Price' => 'required|integer',
        
    ];

    protected function fullTextWildcards($term)
    {
           // removing symbols used by MySQL
           $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
           $term = str_replace($reservedSymbols, '', $term);

           $words = explode(' ', $term);

           foreach ($words as $key => $word) {
               /*
                * applying + operator (required word) only big words
                * because smaller ones are not indexed by mysql
                */
               if (strlen($word) >= 1) {
                   $words[$key] = '+' . $word  . '*';
               }
           }
           
           $searchTerm = implode(' ', $words);

           return $searchTerm;
    }

    public function scopeFullTextSearch($query, $columns, $term)
    {
       $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));

       return $query;
    }

    
}
