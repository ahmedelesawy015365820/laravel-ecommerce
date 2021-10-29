<?php

namespace App\Http\Livewire\Fronted;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartItemComponent extends Component
{

    public $item, $quantity = 1;

    public  function increaseQuantity($rowId)
    {

        $q = Cart::instance('default')->get($rowId)->model->quantity;

        if( $q > $this->quantity){

            $this->quantity++;
            Cart::instance('default')->update($rowId, $this->quantity);

            $this->emit('updatePrice');

        }else{
            $this->alert(
                "warning","this is maximum quantity you can add!"
            );
        }

    }

    public  function decreaseQuantity($rowId)
    {

        if($this->quantity > 1){
            $this->quantity--;
            Cart::instance('default')->update($rowId, $this->quantity);

            $this->emit('updatePrice');

        }

    }

    public function removeCart($rowId)
    {
        $this->emit('removeCart',$rowId);
        $this->emit('updateCart');
    }

    public function mount()
    {
        $this->quantity = Cart::instance('default')->get($this->item)->qty ?? 1;
    }

    public function render()
    {
        return view('livewire.fronted.cart-item-component',[
            'cartItem' =>  Cart::instance('default')->get($this->item)
        ]);
    }
}
