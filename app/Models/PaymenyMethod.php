<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymenyMethod extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status()
    {
        return $this->status? 'Active' : "Inactive";
    }

    public function sandbox()
    {
        return $this->sandbox ? 'Sandbox' : "Live";
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
