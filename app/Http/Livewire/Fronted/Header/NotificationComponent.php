<?php

namespace App\Http\Livewire\Fronted\Header;

use Livewire\Component;

class NotificationComponent extends Component
{

    public $noReadNotificationCount,$noReadNotifications;

    public function getListeners()
    {
        $customer_id = auth()->guard('customer')->user()->id;

        return [
            "echo-notification:App.Models.Customer.{$customer_id},notification" => "mount"
        ];
    }


    public  function mount()
    {
        $this->noReadNotificationCount = auth()->guard('customer')->user()->unreadNotifications()->count();
        $this->noReadNotifications = auth()->guard('customer')->user()->unreadNotifications;
    }

    public function markAsRead($id)
    {
        $notification = auth()->guard('customer')->user()->unreadNotifications->where('id', $id)->first();
        $notification->markAsRead();
        return redirect()->to($notification->data['order_url']);
    }

    public function render()
    {
        return view('livewire.fronted.header.notification-component');
    }
}
