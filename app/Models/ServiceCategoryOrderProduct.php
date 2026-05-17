<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategoryOrderProduct extends Model
{
    protected $fillable = ['category_id', 'product_id', 'quantity'];

    protected $table = 'service_category_order_products'; 

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}