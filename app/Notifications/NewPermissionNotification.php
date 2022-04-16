<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPermissionNotification extends Notification
{
    use Queueable;
    protected $employee;
    protected $permission;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $employee, Permission $permission)
    {
        $this->employee = $employee;
        $this->permission = $permission;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }
/*
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->employee->id,
            'user_name' => $this->employee->civilite . " " .$this->employee->last_name . " " .$this->employee->first_name ,
            'permission_id' => $this->permission->id,
        ];
    } */

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'user_id' => $this->employee->id,
            'user_name' => Str::ucfirst($this->employee->civilite) . " " .$this->employee->last_name . " " .$this->employee->first_name ,
            'permission_id' => $this->permission->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'read_at' => null,
            'created_at' => Carbon::now(),
            'data' => [
                'user_id' => $this->employee->id,
                'user_name' => Str::ucfirst($this->employee->civilite) . " " .$this->employee->last_name . " " .$this->employee->first_name ,
                'permission_id' => $this->permission->id,
            ],
        ]);
    }
}
