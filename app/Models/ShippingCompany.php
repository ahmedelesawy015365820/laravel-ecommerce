<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {

        return $this->belongsToMany(Country::class,'shipping_company_country');

    }

    public function status()
    {
        return $this->status? 'Active' : "Inactive";
    }

    public function fast()
    {
        return $this->fast ? 'Fast delivery' : 'Normal delivery';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
