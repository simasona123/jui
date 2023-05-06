<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Username for user.
     *
     * @var string
     */
    public $username;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token, $username)
    {
        $this->token = $token;
        $this->username = $username;
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
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('JuiHouseCall@example.com', 'Jui House Call Vet')
            ->subject('Atur ulang kata sandi')
            ->greeting('Halo ' . $this->username . '!')
            ->line('Anda menerima pesan untuk mengatur ulang kata sandi dikarenakan Anda memintanya')
            ->action('Atur Ulang Kata Sandi', url('password/reset', $this->token))
            ->line('Jika Anda tidak merasa silahkan biarkan pesan ini. Terima kasih.');
    }
}
