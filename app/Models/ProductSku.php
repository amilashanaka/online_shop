<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
}
