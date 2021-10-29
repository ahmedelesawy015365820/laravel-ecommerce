<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//*************************Start Frontend******************//



// front end auth
Route::namespace('Customer')->group(function () {

    // login route
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // register route
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // reset password route
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', '\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

    // email verify route
    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');

});

Route::namespace('Frontend')->name('frontend.')->group(function () {

    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('/shop/{slug?}', 'FrontendController@shop')->name('shop');
    Route::get('/shop/tag/{slug?}', 'FrontendController@shop_tag')->name('tag');
    Route::get('/shop/subcategory/{slug?}', 'FrontendController@shop_subcategory')->name('subcategory');
    Route::get('/cart', 'FrontendController@cart')->name('cart');
    Route::get('/wishlist', 'FrontendController@wishlist')->name('wishlist');
    Route::get('/product/{slug?}', 'FrontendController@product')->name('detail');

    Route::group(['middleware' => 'assign.guard:customer,/login'], function(){

        Route::get('/dashboard', 'CustomerProfileController@dashboard')->name('customer.dashboard');

        Route::get('/profile', 'CustomerProfileController@profile')->name('customer.profile');
        Route::get('/profile/remove-image', 'CustomerProfileController@remove_profile_image')->name('customer.remove_profile_image');
        Route::patch('/update_profile', 'CustomerProfileController@update_profile')->name('customer.update_profile');

        Route::get('/addresses', 'CustomerProfileController@addresses')->name('customer.addresses');
        Route::get('/orders', 'CustomerProfileController@orders')->name('customer.orders');

        Route::group(['middleware' => 'checkout_cart:customer'],function () {

            Route::get('/checkout', 'FrontendController@checkout')->name('checkout');
            Route::post('/checkout/payment', 'PaymentController@checkout_now')->name('payment');
            Route::get('/checkout/{order_id}/cancel', 'PaymentController@cancel')->name('payment.cancel');
            Route::get('/checkout/complete/{order_id}', 'PaymentController@completed')->name('payment.complete');
            // Route::get('/checkout/webhook/{order_id?}/{env?}', 'PaymentController@webhook')->name('payment.webhook.ipn');

        });
    });

});




//*************************Start Backend******************//

Route::name('admin.')->prefix('admin')->group(function () {

    // back end auth
    Route::namespace('Auth')->group(function () {

        // login route
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');

        // reset password route
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

    });

    Route::group(['middleware' => 'assign.guard:web,admin/login'], function()
    {

        Route::namespace('Backend')->group(function () {

            // start dashboard
            Route::get('/', 'DashboardController@index')->name('index');

            // start roles and permision
            Route::resource('roles','RoleController');
            Route::resource('users','UserController')->except('show');

            // start profile
            Route::resource('profile','ProfileController')->except('edit','store','show','destroy');

            // start product
            Route::resource('category','CategoryController')->except('show','create','edit');

            // start product-categories
            Route::resource('product-categories','ProductCategoryController')->except('show');

            // start product
            Route::resource('product','ProductController');

            // start tags
            Route::resource('tag','TagController')->except('show');

            // start ProductCoupon
            Route::resource('product_coupon','ProductCouponController')->except('show');

            // start Review
            Route::resource('review','ProductReviewController')->except('show');

            // start customer
            Route::resource('customer','CustomerController');

            // start country
            Route::resource('country','CountryController')->except('show','create','edit');

            // start state
            Route::resource('state','StateController')->except('show','create','edit');

            // start city
            Route::resource('city','CityController')->except('show','create','edit');

            // start customer address
            Route::resource('customer_address','CustomerAddressController')->except('create','store');
            // Route::get('customer_address/customer/{name?}', 'CustomerAddressController@name')->name('name');
            Route::get('customer_address/state/{id?}', 'CustomerAddressController@state')->name('state');
            Route::get('customer_address/city/{id?}', 'CustomerAddressController@city')->name('city');

            // start shipping company
            Route::resource('shippingcompany','ShippingCompanyController')->except('show');

            // start payment method
            Route::resource('payment_method','PaymenyMethodController')->except('show');

            // orders
            Route::resource('order','OrderController')->except('create','store','edit');


        });

    });

});

