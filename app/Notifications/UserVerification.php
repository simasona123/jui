<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserVerification extends Notification implements ShouldQueue
{
    use Queueable;

    private $status;
    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $user = null)
    {
        $this->status = $status;
        $this->user = $user;
        //status = 1 -> Pemberitahuan bahwa email telah terverifikasi oleh Admin
        //status = 2 -> Pemberitahuan untuk user memverifikasi emailnya
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
    public function toMail(object $notifiable)
    {
        if($this->status == 1){
            return (new MailMessage)
                ->line('Akun telah diverifikasi oleh Admin.')
                ->line('Terima kasih atas kepercayaan anda menggunakan aplikasi kami');

        }else if($this->status == 2){
            return (new MailMessage)
                ->line('Mohon untuk konfirmasi email akun JUI dengan mengunjungi url di bawah.')
                ->action('Verifikasi Email', url('/email-konfirmasi/' . $this->user->id))
                ->line('Terima kasih banyak atas perhatiannya.');
        }
       
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => 'Akun Sudah Diverifikasi',
        ];
    }
}
