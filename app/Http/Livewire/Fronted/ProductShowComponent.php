<?php

namespace App\Http\Livewire\Fronted;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductShowComponent extends Component
{

    public $quantity = 1, $product;

    public function mounted($product)
    {
        $this->product = $product;
    }

    public  function increaseQuantity()
    {

        if( $this->product->quantity > $this->quantity){
            $this->quantity++;
        }else{
            $this->alert(
                "warning","this is maximum quantity you can add!"
            );
        }
    }

    public  function decreaseQuantity()
    {

        if($this->quantity > 1){
            $this->quantity--;
        }

    }

    public function addCart()
    {

        $deblucated = Cart::instance('default')->search(function ($cartItem, $rowId){

            return $cartItem->id == $this->product->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('default')->add($this->product->id, $this->product->name,$this->quantity,$this->product->price)->associate(Product::class);

            $this->quantity = 1;
            $this->emit('updateCart');

            $this->alert(
                "success","Product add in your cart successful."
            );

        }
    }

    public  function addwishlist()
    {
        $deblucated = Cart::instance('wishlist')->search(function ($cartItem, $rowId){

            return $cartItem->id == $this->product->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('wishlist')->add($this->product->id, $this->product->name,1,$this->product->price)->associate(Product::class);
            $this->emit('updateCart');

            $this->alert(
                "success","Product add in your wish list cart successful."
            );

        }
    }


    public function render()
    {
        return view('livewire.fronted.product-show-component');
    }
}
