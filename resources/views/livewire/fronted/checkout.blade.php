<div class="row">
    <div class="col-lg-8">
        <h2 class="h5 text-uppercase mb-4"> Addresses</h2>
        <div class="row">
            @forelse($addresses as $address)
                <div class="col-6 form-group">
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            id="address-{{ $address->id }}"
                            class="custom-control-input"
                            wire:model="customer_address_id"
                            wire:click="updateShippingCompanies()"
                            value="{{ $address->id }}">
                        <label for="address-{{ $address->id }}" class="custom-control-label text-small">
                            <b>{{ $address->address_title }}</b>
                            <small>
                                {{ $address->address }}<br>
                                {{ $address->country->name }} - {{ $address->state->name }} - {{ $address->city->name }}
                            </small>
                        </label>
                    </div>
                </div>

            @empty
                <p>No addresses found</p><pre> </pre><a href="#">Add an address</a>
            @endforelse
        </div>

        @if ($customer_address_id != 0)
            <h2 class="h5 text-uppercase mb-4">Shipping Company</h2>
            <div class="row">
                @forelse($shippingcompanies as $shippingcompany)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="shippingcompany-{{ $shippingcompany->id }}"
                                class="custom-control-input"
                                wire:model="shipping_company_id"
                                wire:click="updateShippingCost()"
                                value="{{ $shippingcompany->id }}">
                            <label for="shippingcompany-{{ $shippingcompany->id }}" class="custom-control-label text-small">
                                <b>{{ $shippingcompany->name }}</b>
                                <small>
                                    {{ $shippingcompany->description }} - ({{ $shippingcompany->cost }})
                                </small>
                            </label>
                        </div>
                    </div>

                @empty
                    <p>No shipping companies found</p>
                @endforelse
            </div>
        @endif

        @if ($customer_address_id != 0 && $shipping_company_id != 0)
            <h2 class="h5 text-uppercase mb-4">Payment Method</h2>
            <div class="row">
                @forelse($payment_methods as $payment_method)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="paymentmethod-{{ $payment_method->id }}"
                                class="custom-control-input"
                                wire:model="payment_method_id"
                                wire:click="paymentmethodCost()"
                                value="{{ $payment_method->id }}">
                            <label for="paymentmethod-{{ $payment_method->id }}" class="custom-control-label text-small">
                                <b>{{ $payment_method->name }}</b>
                            </label>
                        </div>
                    </div>

                @empty
                    <p>No payment method found</p>
                @endforelse
            </div>
        @endif


        @if ($customer_address_id != 0 && $shipping_company_id != 0 && $payment_method_id != 0)
            @if (\Str::lower($payment_method_code) == 'ppex')
            <form action="{{ route('frontend.payment') }}" method="post">
                @csrf
                <input type="hidden" name="customer_address_id" value="{{ old('customer_address_id', $customer_address_id) }}" class="form-control">
                <input type="hidden" name="shipping_company_id" value="{{ old('shipping_company_id', $shipping_company_id) }}" class="form-control">
                <input type="hidden" name="payment_method_id" value="{{ old('payment_method_id', $payment_method_id) }}" class="form-control">
                <button type="submit" name="submit" class="btn btn-dark btn-sm btn-block">
                    Continue to checkout with Visa/Mastercard
                </button>
            </form>
            @endif
        @endif

    </div>


    <!-- ORDER SUMMARY-->
    <div class="col-lg-4">
      <div class="card border-0 rounded-0 p-lg-4 bg-light">
        <div class="card-body">
          <h5 class="text-uppercase mb-4">Your order</h5>
          <ul class="list-unstyled mb-0">
            @if ($subtotal != 0)
            <li class="d-flex align-items-center justify-content-between">
                <strong class="small font-weight-bold">SubTotal</strong>
                <span class="text-muted small">${{$subtotal}}</span>
            </li>
            @if (session()->has('shipping'))
                <li class="d-flex align-items-center justify-content-between">
                    <strong class="small font-weight-bold">Shipping <small>({{session()->get('shipping')['code']}})</small></strong>
                    <span class="text-muted small">${{session()->get('shipping')['cost']}}</span>
                </li>
            @endif
            @if (session()->has('coupon'))
                <li class="d-flex align-items-center justify-content-between">
                    <strong class="small font-weight-bold">discount <small>({{session()->get('coupon')['code']}})</small></strong>
                    <span class="text-muted small">-${{session()->get('coupon')['discount']}}</span>
                </li>
            @endif
            <li class="border-bottom my-2"></li>
            <li class="d-flex align-items-center justify-content-between">
                <strong class="small font-weight-bold">Tax</strong>
                <span class="text-muted small">${{$tax}}</span>
            </li>
            <li class="border-bottom my-2"></li>
            <li class="d-flex align-items-center justify-content-between">
                <strong class="text-uppercase small font-weight-bold">Total</strong>
                <span>${{$total}}</span>
            </li>
            <li class="border-bottom my-2"></li>
            <li>
                @if (!session()->has('coupon'))
                <form  wire:submit.prevent="applyDiscount()">
                        <input type="text" class="form-control" placeholder="Enter your coupon" wire:model="coupon">

                        <button type="submit" class="btn btn-sm btn-dark btn-block">
                            <i class="fas fa-gift mr2"></i> Apply Coupon
                        </button>
                </form>
                @else
                <button type="button" wire:click.prevent="removeCoupon" class="btn btn-danger btn-sm btn-block">
                    <i class="fas fa-gift mr2"></i> Remove coupon
                </button>
                @endif
            </li>
            @else
            <li class="d-flex align-items-center justify-content-center">
                <span>your cart is emity!</span>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
