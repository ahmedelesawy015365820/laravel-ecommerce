<?php

namespace App\Http\Livewire\Fronted;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductModelShared extends Component
{

    public $productModelCount = false;
    public $productModel = [];
    public $quantity = 1;

    protected $listeners = ['productModelShow'];

    public function productModelShow($slug)
    {

        $this->productModelCount = true;
        $this->productModel = Product::withAvg('reviews','rating')->with(['media' => function ($q) {

            return $q->select('file_name','mediable_id','mediable_type');

        }
        ])
        ->whereSlug($slug)->Active()->Quantity()->ActiveCategory()->firstOrFail();

    }

    public  function increaseQuantity()
    {

        if( $this->productModel->quantity > $this->quantity){
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

            return $cartItem->id == $this->productModel->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('default')->add($this->productModel->id, $this->productModel->name,$this->quantity,$this->productModel->price)->associate(Product::class);

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

            return $cartItem->id == $this->productModel->id;

        });

        if($deblucated->isNotEmpty()){

            $this->alert(
                "error","Product already exist!"
            );

        }else{

            Cart::instance('wishlist')->add($this->productModel->id, $this->productModel->name,1,$this->productModel->price)->associate(Product::class);
            $this->emit('updateCart');

            $this->alert(
                "success","Product add in your wish list cart successful."
            );

        }
    }

    public function render()
    {
        return view('livewire.fronted.product-model-shared');
    }
}
