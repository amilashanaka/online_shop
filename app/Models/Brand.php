<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function sub_categories(){
        return $this->belongsToMany(SubCategory::class, 'brand_sub_category');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
