<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function status()
    {
        return $this->status ? 'Active' : "Inactive";
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function shippingcompany()
    {

        return $this->belongsToMany(ShippingCompany::class,'shipping_company_country');

    }

}
