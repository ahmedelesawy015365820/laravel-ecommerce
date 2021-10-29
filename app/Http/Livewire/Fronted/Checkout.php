<?php

namespace App\Http\Livewire\Fronted;

use App\Models\CustomerAddress;
use App\Models\PaymenyMethod;
use App\Models\ProductCopon;
use App\Models\ShippingCompany;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{

    public $subtotal , $total ,$tax,$coupon, $coupon_code,$addresses,$customer_address_id = 0,
            $shippingcompanies, $shipping_company_id = 0, $payment_methods,$payment_method_id = 0,
            $payment_method_code;

    public function mount()
    {
        $this->subtotal = getNumbers()->get('subtotal');
        $this->total = getNumbers()->get('total');
        $this->tax = getNumbers()->get('productTaxes');

        $this->customer_address_id = session()->has('customer_address') ? session()->get('customer_address')['id_customer_address'] : 0 ;

        $this->shippingcompanies = session()->has('customer_address') ?
            CustomerAddress::whereId($this->customer_address_id)->first()->country->shippingcompany
            : null;

        $this->shipping_company_id = session()->has('shipping') ? session()->get('shipping')['id_shipping_company'] : 0 ;

        $this->addresses = Auth::guard('customer')->user()->addresses;

        $this->payment_methods = PaymenyMethod::whereStatus(true)->get();

    }

    public function applyDiscount()
    {
        if(getNumbers()->get('total') > 0){

            $coupon =  ProductCopon::whereCode($this->coupon)->whereStatus(true)->first();

            if(!$coupon){
                $this->coupon = '';
                $this->alert(
                    "error","Coupon is inValid."
                );
            }else{
                $couponValue = $coupon->discount($this->subtotal);

                if($couponValue > 0){
                    session()->put('coupon',[
                        'discount' => $couponValue,
                        'code' => $coupon->code,
                        'value' => $coupon->value,
                    ]);

                    $this->coupon_code = session()->get('coupon')['code'];

                    $this->mount();

                    $this->alert(
                        "success","Coupon is applied successful."
                    );

                }else{

                    $this->alert(
                        "error"," Products coupon is invalid."
                    );

                }

            }

        }else{
            $this->coupon = '';
            $this->alert(
                "error","No Products available in your cart."
            );
        }
    }


    public function removeCoupon()
    {
        session()->remove('coupon');
        $this->mount();
        $this->coupon = '';
        $this->alert(
            "success","coupon is removed."
        );

    }

    public function updateShippingCompanies()
    {

        $addresses = CustomerAddress::whereId($this->customer_address_id)->first();

        session()->put('customer_address', [
            'id_customer_address' => $this->customer_address_id,
        ]);

        $this->shippingcompanies = $addresses->country->shippingcompany;

        $this-> shipping_company_id = 0;

    }

    public function updateShippingCost()
    {

        $shoppingcompany = ShippingCompany::whereId( $this->shipping_company_id)->first();

        session()->put('shipping', [
            'cost' => $shoppingcompany->cost,
            'code' => $shoppingcompany->code,
            'id_shipping_company' => $this->shipping_company_id
        ]);

        $this->mount();

        $this->alert(
            "success","Shipping cost is applied successfully"
        );

        $this->payment_method_id = 0;

    }

    public function paymentmethodCost()
    {

        $payment = PaymenyMethod::whereId($this->payment_method_id)->first();

        $this->payment_method_code = $payment->code;

    }



    public function render()
    {
        return view('livewire.fronted.checkout');
    }
}

