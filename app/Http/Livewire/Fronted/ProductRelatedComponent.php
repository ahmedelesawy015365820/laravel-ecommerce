<?php

namespace App\Http\Livewire\Fronted;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductRelatedComponent extends Component
{

    public $item, $quantity = 1;

    public function mounted($item)
    {
        $this->item = $item;
    }

    public function addCart()
    {

        $deblucated = Cart::instance('default')->search(function ($cartItem, $rowId){

            return $cartItem->id == $this->item->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('default')->add($this->item->id, $this->item->name,1,$this->item->price)->associate(Product::class);
            $this->emit('updateCart');

            $this->alert(
                "success","Product add in your cart successful."
            );

        }
    }

    public  function addwishlist()
    {

        $deblucated = Cart::instance('wishlist')->search(function ($cartItem, $rowId){

            return $cartItem->id == $this->item->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('wishlist')->add($this->item->id, $this->item->name,1,$this->item->price)->associate(Product::class);
            $this->emit('updateCart');

            $this->alert(
                "success","Product add in your wish list cart successful."
            );

        }
    }

    public function render()
    {
        return view('livewire.fronted.product-related-component');
    }
}
