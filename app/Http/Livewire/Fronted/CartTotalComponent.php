<?php

namespace App\Http\Livewire\Fronted;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartTotalComponent extends Component
{

    public $subtotal , $total ,$tax;

    protected $listeners = ['updatePrice'];

    public function mount()
    {
        $this->subtotal = Cart::subtotal();
        $this->total = Cart::total();
        $this->tax = Cart::tax();

    }

    public function updatePrice()
    {
        $this->subtotal = Cart::subtotal();
        $this->total = Cart::total();
        $this->tax = Cart::tax();

    }

    public function render()
    {
        return view('livewire.fronted.cart-total-component');
    }
}
