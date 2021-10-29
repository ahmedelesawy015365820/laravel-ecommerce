<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public  function  index()
    {

        $categories = Category::get();

        return view('frontend.index',compact('categories'));
    }

    public  function  product($slug)
    {

        $product = Product::with(['media' => function ($q) {

            return $q->select('mediable_id','mediable_type','file_name');

        },
        'category'  => function ($q) {

            return $q->select('id','name');

        },
        'tags','reviews'])->withAvg('reviews','rating')->whereSlug($slug)->
        Active()->Quantity()->ActiveCategory()->firstOrFail();

        $related = Product::with(['firstMedia' => function ($q) {

            return $q->select('mediable_id','mediable_type','file_name');

        }])->whereHas('category', function ($q) use( $product){

            return $q->whereId($product->category->id)->whereStatus(true);

        })->inRandomOrder()->Active()->Quantity()->take(4)->get();

        return view('frontend.product',compact('product','related'));
    }

    public  function  shop($slug = null)
    {
        $categories = Category::with('category_product')->get();

        $tags = Tag::whereStatus(true)->get();

        return view('frontend.shop',compact('categories','tags','slug'));
    }

    public  function  shop_subcategory($slug = null)
    {
        $categories = Category::with('category_product')->get();

        $tags = Tag::whereStatus(true)->get();

        return view('frontend.shop_subcategory',compact('categories','tags','slug'));
    }

    public  function shop_tag($slug = null)
    {
        $categories = Category::with('category_product')->get();

        $tags = Tag::whereStatus(true)->get();

        return view('frontend.shop_tag',compact('categories','tags','slug'));
    }

    public  function  cart()
    {

        $carts = Cart::content();
        return view('frontend.cart',compact('carts'));
    }

    public  function  wishlist()
    {

        $wishlist = Cart::instance("wishlist")->content();

        return view('frontend.wishlist',compact('wishlist'));
    }

    public  function  checkout()
    {
        return view('frontend.checkout');
    }


}
