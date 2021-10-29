<?php

namespace App\Http\Livewire\Fronted\Customer;

use App\Models\Order;
use App\Models\OrderTransaction;
use Livewire\Component;
use Livewire\WithPagination;


class OrderComponent extends Component
{

    public $showOrder = false;
    public $asad, $closeOrder = true;


    public function displayOrder($id)
    {

        if($this->showOrder == true){
            $this->close();
        }

        $this->asad = Order::with('products')->find($id);
        $this->closeOrder = false;
        $this->showOrder = true;
    }

    public function requestReturnOrder($id)
    {
        $order = Order::whereId($id)->first();

        $order->update([
            'order_status' => Order::REFUNDED_REQUEST
        ]);

        $order->transactions()->create([
            'transaction' => OrderTransaction::REFUNDED_REQUEST,
            'transaction_number' => $order->transactions()->whereTransaction(OrderTransaction::PAYMENT_COMPLETED)->first()->transaction_number,
        ]);

        $this->alert('success', 'Your request is sent successfully');

        return redirect()->route('frontend.customer.orders');
    }

    function close()
    {
        $this->closeOrder = true;
        $this->showOrder = false;
    }

    public function render()
    {
        return view('livewire.fronted.customer.order-component',[
            'orders' => auth()->guard('customer')->user()->orders
        ]);
    }
}
