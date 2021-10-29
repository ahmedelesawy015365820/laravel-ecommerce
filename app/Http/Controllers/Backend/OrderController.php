<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositery\Order\OrderInterfaceRepositry;

class OrderController extends Controller
{

    protected $order;


    function __construct(OrderInterfaceRepositry $order){

        $this->order = $order;

        $this->middleware('permission:order-list', ['only' => ['index']]);
        $this->middleware('permission:order-edit', ['only' => ['update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->order->index($request);
    }

    public function show(Order $order)
    {
        return $this->order->show($order);
    }

    public function update(Request $request, Order $order)
    {
        return $this->order->update($request,$order);
    }

    public function destroy(Order $order)
    {
        return $this->order->destroy($order);
    }
}
