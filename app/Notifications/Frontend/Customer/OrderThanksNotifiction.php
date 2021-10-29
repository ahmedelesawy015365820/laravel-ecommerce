<?php

namespace App\Notifications\Frontend\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class OrderThanksNotifiction extends Notification implements ShouldQueue
{
    use Queueable;

    public $order, $attachment;


    public function __construct($order,$attachment)
    {
        $this->order = $order;
        $this->attachment = $attachment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->greeting('Dear, ' . $this->order->customer->full_name)
        ->line('Thank you for purchase the order.')
        ->line('Thank you for using our application!')
        ->attach($this->attachment, [
            'as' => 'order-'. $this->order->ref_id .'.pdf',
            'mime' => 'application/pdf',
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'customer_name' => $this->order->customer->full_name,
            'order_ref' => $this->order->ref_id,
            'order_url' => route('frontend.customer.orders'),
            'created_date' => $this->order->created_at->format('M d, Y'),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'customer_name' => $this->order->customer->full_name,
                'order_ref' => $this->order->ref_id,
                'order_url' => route('frontend.customer.orders'),
                'created_date' => $this->order->created_at->format('M d, Y'),
            ]
        ]);
    }

}
