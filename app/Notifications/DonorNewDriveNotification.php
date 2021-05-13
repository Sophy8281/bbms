<?php

namespace App\Notifications;

use APP\Models\Drive;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Nexmo\Laravel\Facade\Nexmo;

class DonorNewDriveNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     public function __construct(Drive $new_drive)
    {
        $this->new_drive = $new_drive;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');

                    ->line('We are glad to inform you that we have scheduled a new Blood Drive.')
                    ->line('VENUE:' . $this->new_drive->location)
                    ->line('DATE:' . $this->new_drive->date)
                    ->line('TIME:' .  $this->new_drive->time)
                    ->line('Thank you  and see you there, then!');
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
            //
        ];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    // public function toNexmo($notifiable)
    // {
    //       Nexmo::message()->send([
    //         'to' => '+254'.(int) $phone,
    //         'from' => 'BBMS',
    //         'text' => 'Thank you for your blood donation. It means a lot to us and people in need of blood.',
    //     ]);
    //     // return (new NexmoMessage)
    //     //             // ->content('Your SMS message content');
    //     //             ->from('BBMS')
    //     //             ->content('We are glad to inform you that we have scheduled a new Blood Drive.')
    //     //             ->content('VENUE:' . $this->new_drive->location)
    //     //             ->content('DATE:' . $this->new_drive->date)
    //     //             ->content('TIME:' .  $this->new_drive->time)
    //     //             ->content('Thank you  and see you there, then!');
    //     //             // ->content('New Blood Drive Scheduled at' . $this->new_drive->location .'on'. $this->new_drive->date . 'from'. $this->new_drive->time);
    // }
}
