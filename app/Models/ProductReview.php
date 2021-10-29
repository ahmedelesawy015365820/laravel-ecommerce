<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function status()
    {
        return $this->status? 'Active' : "Inactive";
    }
}
