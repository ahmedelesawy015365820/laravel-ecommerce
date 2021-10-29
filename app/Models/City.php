<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function status()
    {
        return $this->status? 'Active' : "Inactive";
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
