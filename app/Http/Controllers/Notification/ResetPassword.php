<?php
namespace App\Http\Controllers\Notification;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
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
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Восстановление пароля!'))
            ->line(Lang::getFromJson('Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.'))
            ->action(Lang::getFromJson('Сброс пароля'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(Lang::getFromJson('Срок действия ссылки для сброса пароля истекает через :count минут.', ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::getFromJson('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.'));
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
