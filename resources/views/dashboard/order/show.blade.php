@extends('layouts.master')
@section('title')
    Show Order
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admin</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Show Order</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-8 col-md-8">

        <div class="card">

            <div class="card-header pb-0">
                <div class="row justify-content-between">
                    <div class="col-xl-3 col-xl-3 col-md-4 row">
                        <div class="form-inline">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">Order</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-5 row align-items-center flex-row-reverse">
                        <form class="form-inline" id="update" action="{{ route('admin.order.update', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group ">
                                <div class="form-group mb-2 col-4">
                                    <select
                                    name="order_status"
                                    class="form-control form-control-sm"
                                    onchange="document.getElementById('update').submit()"
                                    >
                                        <option>--status--</option>
                                        @foreach ($new_status as $key => $value)
                                        <option value="{{$key}}">
                                            {{$value}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Ref. Id</th>
                            <td>{{ $order->ref_id }}</td>
                            <th>Customer</th>
                            <td><a href="{{ route('admin.customer.show', $order->customer_id) }}">{{ $order->customer->full_name }}</a></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><a href="{{ route('admin.customer_address.show', $order->customer_address_id) }}">{{ $order->customer_address->address_title }}</a></td>
                            <th>Shipping Company</th>
                            <td>{{ $order->shipping_company->name . '('. $order->shipping_company->code .')' }}</td>
                        </tr>
                        <tr>
                            <th>Created date</th>
                            <td>{{ $order->created_at->format('d-m-Y h:i a') }}</td>
                            <th>Order status</th>
                            <td>{!! $order->statusWithLabel() !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4">

        <div class="card" id="print">
            <div class="card-body">

                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Cost</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>{{ $order->currency() . $order->subtotal }}</td>
                        </tr>
                        <tr>
                            <th>Discount code</th>
                            <td>{{ $order->discount_code }}</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>{{ $order->currency() . $order->discount }}</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>{{ $order->currency() . $order->shipping }}</td>
                        </tr>
                        <tr>
                            <th>tax</th>
                            <td>{{ $order->currency() . $order->tax }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ $order->currency() . $order->total }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class=" col-md-12">

        <div class="card" id="print">
            <div class="card-body">

                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Transactions</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Transaction</th>
                            <th>Transaction number</th>
                            <th>Payment result</th>
                            <th>Action date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($order->transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->status($transaction->transaction) }}</td>
                                <td>{{ $transaction->transaction_number }}</td>
                                <td>{{ $transaction->payment_result }}</td>
                                <td>{{ $transaction->created_at->format('Y-m-d h:i a') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No transactions found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class=" col-md-12">

        <div class="card" id="print">
            <div class="card-body">

                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Details</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($order->products as $product)
                            <tr>
                                <td><a href="{{ route('admin.product.show', $product->id) }}">{{ $product->name }}</a></td>
                                <td>{{ $product->pivot->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No products found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

<!--end Modal delete -->

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

