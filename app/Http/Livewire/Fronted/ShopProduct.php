<?php

namespace App\Http\Livewire\Fronted;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProduct extends Component
{

    use WithPagination;

    public $categories,$tags,$paginateLimit = 12, $sortingBy = 'default',$slug;
    protected $paginationTheme = 'bootstrap';

    public function mount($categories,$tags,$slug)
    {
        $this->categories = $categories;
        $this->tags = $tags;
        $this->slug = $slug;
    }

    public function addCart($id)
    {

        $product = Product::whereId($id)->firstOrFail();

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

        $product = Product::whereId($id)->firstOrFail();

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
        switch ($this->sortingBy){

            case 'popularity':
                $sort_field ='id' ;
                $sort_type = 'asc';
                break;

            case 'low-high':
                $sort_field ='price' ;
                $sort_type = 'asc';
                break;

            case 'high-low':
                $sort_field ='price' ;
                $sort_type = 'desc';
                break;

            default :
                $sort_field ='id' ;
                $sort_type = 'asc';
            }


        $Products = Product::with(['firstMedia' => function ($q) {
            return $q->select('file_name','mediable_type','mediable_id');
        }])
        ->whereHas('bigcategory',function ($q){

            $q->whereSlug($this->slug);

        })->orderBy($sort_field,$sort_type)->paginate($this->paginateLimit);

        return view('livewire.fronted.shop-product',['Products' => $Products]);
    }
}
