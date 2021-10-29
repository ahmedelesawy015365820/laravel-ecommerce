<?php

namespace App\Http\Livewire\Fronted;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistComponent extends Component
{
    public $item;

    public function removeFromWishList($rowId)
    {
        $this->emit('removeWishList',$rowId);
        $this->emit('updateCart');
    }

    public function moveToCart($rowId)
    {
        $this->emit('moveCart',$rowId);
    }

    public function render()
    {
        return view('livewire.fronted.wishlist-component',[
            'wishlistItem' => Cart::instance('wishlist')->get($this->item)
        ]);
    }
}
