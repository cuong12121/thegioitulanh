<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imagescontent extends Model
{
    public $table = 'imagescontent';
    public $fillable = [
        'image',
        'product_id',
        'option'
        
    ];
}
