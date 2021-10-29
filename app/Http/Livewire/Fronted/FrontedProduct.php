<?php

namespace App\Http\Livewire\Fronted;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class FrontedProduct extends Component
{

    public function addCart($id)
    {

        $product = Product::whereId($id)->Active()
        ->Quantity()->ActiveCategory()->firstOrFail();

        $deblucated = Cart::instance('default')->search(function ($cartItem, $rowId) use($product){

            return $cartItem->id == $product->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('default')->add($product->id, $product->name,1,$product->price)->associate(Product::class);
            $this->emit('updateCart');

            $this->alert(
                "success","Product add in your cart successful."
            );

        }
    }

    public  function addwishlist($id)
    {

        $product = Product::whereId($id)->Active()
        ->Quantity()->ActiveCategory()->firstOrFail();

        $deblucated = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use($product){

            return $cartItem->id == $product->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('wishlist')->add($product->id, $product->name,1,$product->price)->associate(Product::class);
            $this->emit('updateCart');

            $this->alert(
                "success","Product add in your wish list cart successful."
            );

        }
    }

    public function render()
    {
        return view('livewire.fronted.fronted-product',[
            'Productfeatures' => Product::with(['firstMedia' => function ($q) {

                return $q->select('file_name','mediable_id','mediable_type');

            }])->inRandomOrder()->Featured()->Active()
               ->Quantity()->ActiveCategory()->take(8)->get()
        ]);
    }
}
