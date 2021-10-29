<?php

namespace App\Providers;

use App\Repositery\Address\AddressInterfaceRepositry;
use App\Repositery\Address\AddressRepository;
use App\Repositery\Category\CategoryInterfaceRepositry;
use App\Repositery\Category\CategoryRepository;
use App\Repositery\City\CityInterfaceRepositry;
use App\Repositery\City\CityRepository;
use App\Repositery\Country\CountryInterfaceRepositry;
use App\Repositery\Country\CountryRepository;
use App\Repositery\Coupon\ProductCouponInterfaceRepositry;
use App\Repositery\Coupon\ProductCouponRepository;
use App\Repositery\Customer\CustomerInterfaceRepositry;
use App\Repositery\Customer\CustomerRepository;
use App\Repositery\Order\OrderInterfaceRepositry;
use App\Repositery\Order\OrderRepository;
use App\Repositery\PaymentMethod\PaymentMethodInterfaceRepositry;
use App\Repositery\PaymentMethod\PaymentMethodRepository;
use App\Repositery\Product\ProductInterfaceRepositry;
use App\Repositery\Product\ProductRepository;
use App\Repositery\ProductCategory\ProductCategoryInterfaceRepositry;
use App\Repositery\ProductCategory\ProductCategoryRepository;
use App\Repositery\Profile\ProfileInterfaceRepositry;
use App\Repositery\Profile\ProfileRepository;
use App\Repositery\Review\ProductReviewInterfaceRepositry;
use App\Repositery\Review\ProductReviewRepository;
use App\Repositery\Role\RoleInterfaceRepositry;
use App\Repositery\Role\RoleRepositry;
use App\Repositery\ShippingCompany\ShippingCompanyInterfaceRepositry;
use App\Repositery\ShippingCompany\ShippingCompanyRepository;
use App\Repositery\State\StateInterfaceRepositry;
use App\Repositery\State\StateRepository;
use App\Repositery\Tag\TagInterfaceRepositry;
use App\Repositery\Tag\TagRepository;
use App\Repositery\User\UserInterfaceRepositry;
use App\Repositery\User\UserRepositry;
use Illuminate\Support\ServiceProvider;

class ReposteryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterfaceRepositry::class , UserRepositry::class);
        $this->app->bind(RoleInterfaceRepositry::class , RoleRepositry::class);
        $this->app->bind(ProductCategoryInterfaceRepositry::class , ProductCategoryRepository::class);
        $this->app->bind(CategoryInterfaceRepositry::class , CategoryRepository::class);
        $this->app->bind(TagInterfaceRepositry::class , TagRepository::class);
        $this->app->bind(ProductInterfaceRepositry::class , ProductRepository::class);
        $this->app->bind(ProductCouponInterfaceRepositry::class , ProductCouponRepository::class);
        $this->app->bind(ProductReviewInterfaceRepositry::class , ProductReviewRepository::class);
        $this->app->bind(CustomerInterfaceRepositry::class , CustomerRepository::class);
        $this->app->bind(CountryInterfaceRepositry::class , CountryRepository::class);
        $this->app->bind(CityInterfaceRepositry::class , CityRepository::class);
        $this->app->bind(StateInterfaceRepositry::class , StateRepository::class);
        $this->app->bind(AddressInterfaceRepositry::class , AddressRepository::class);
        $this->app->bind(ShippingCompanyInterfaceRepositry::class , ShippingCompanyRepository::class);
        $this->app->bind(ProfileInterfaceRepositry::class , ProfileRepository::class);
        $this->app->bind(PaymentMethodInterfaceRepositry::class , PaymentMethodRepository::class);
        $this->app->bind(OrderInterfaceRepositry::class , OrderRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
