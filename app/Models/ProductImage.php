<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_image_url', 'product_id'];
    // protected $guarded = [];
    
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
