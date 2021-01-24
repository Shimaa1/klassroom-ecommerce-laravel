<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $order;
    public $user;

    public function __construct(Order $order,User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Dear '.$this->user->name)
                    ->line('Your order has been placed successfully.')
                    ->line('Your order ID is '.$this->order->id)
                    ->action('View Details', route('order.details',$this->order->id))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
