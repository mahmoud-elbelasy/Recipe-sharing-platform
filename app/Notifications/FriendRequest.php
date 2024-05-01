<?php

namespace App\Notifications;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class FriendRequest extends Notification
{
    use Queueable;
    protected $friendRequest;
    /**
     * Create a new notification instance.
     */
    public function __construct($friendRequest)
    {
        // dd($friendRequest);
        $this->friendRequest = $friendRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $user = Auth::user();
        
        return (new MailMessage)
                    ->greeting("hello")
                    ->line('you have new friend request')
                    ->from($user->email,$user->name)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
