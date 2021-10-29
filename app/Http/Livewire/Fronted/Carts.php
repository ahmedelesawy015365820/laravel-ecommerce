<?php

namespace App\Http\Livewire\Fronted;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Carts extends Component
{

    public $cartCount, $wishlist ;

    protected $listeners = ['updateCart','removeCart' => 'removeC','removeWishList','moveCart'];

    public function mount()
    {

        $this->cartCount = Cart::instance('default')->count();
        $this->wishlist = Cart::instance('wishlist')->count();

    }

    public function updateCart()
    {
        $this->cartCount = Cart::instance('default')->count();
        $this->wishlist = Cart::instance('wishlist')->count();
    }

    public function removeC($rowId)
    {

        Cart::instance('default')->remove($rowId);
        $this->alert(
            "success","Item remove from your cart!"
        );

        $this->emit('updatePrice');

        if(Cart::instance('default')->count() == 0){
            return redirect()->route('frontend.cart');
        }

    }


    public function removeWishList($rowId)
    {

        Cart::instance('wishlist')->remove($rowId);
        $this->alert(
            "success","Item remove from your wishlist!"
        );

        if(Cart::instance('wishlist')->count() == 0){
            return redirect()->route('frontend.wishlist');
        }

    }

    public function moveCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        $deblucated = Cart::instance('default')->search(function ($cartItem, $rowId) use($item){

            return $cartItem->id == $item->id;

        });

        if($deblucated->isNotEmpty()){

            Cart::instance('wishlist')->remove($rowId);

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('default')->add($item->id, $item->name,1,$item->price)->associate(Product::class);

            Cart::instance('wishlist')->remove($rowId);

            $this->alert(
                "success","Product add in your cart successful."
            );

        }

        if(Cart::instance('wishlist')->count() == 0){
            return redirect()->route('frontend.wishlist');
        }else{
            $this->emit('updateCart');
        }


    }


    public function render()
    {
        return view('livewire.fronted.carts');
    }
}
