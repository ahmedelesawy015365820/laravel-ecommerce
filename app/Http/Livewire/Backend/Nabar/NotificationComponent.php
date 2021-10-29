<?php

namespace App\Http\Livewire\Backend\Nabar;

use Livewire\Component;

class NotificationComponent extends Component
{

    public $noReadNotificationCount,$noReadNotifications;

    public function getListeners()
    {
        $admin_id = auth()->user()->id;

        return [
            "echo-notification:App.Models.User.{$admin_id},notification" => "mount"
        ];
    }


    public  function mount()
    {
        $this->noReadNotificationCount = auth()->user()->unreadNotifications()->count();
        $this->noReadNotifications = auth()->user()->unreadNotifications;
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
        $notification->markAsRead();
        return redirect()->to($notification->data['order_url']);
    }

    public function render()
    {
        return view('livewire.backend.nabar.notification-component');
    }
}
