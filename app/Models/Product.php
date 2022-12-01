<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function product_keywords(){
        return $this->hasMany(ProductKeyword::class);
    }

    public function product_medias(){
        return $this->hasMany(ProductMedia::class);
    }

    public function product_sku(){
        return $this->hasOne(ProductSku::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
}
