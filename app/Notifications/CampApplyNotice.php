<?php

namespace App\Notifications;

use App\Models\Apply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Str;

class CampApplyNotice extends Notification
{
    use Queueable;

    public Apply $apply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Apply $apply)
    {
        $this->apply = $apply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->subject($this->apply->camp_time->camp->name . '報名成功通知')
            ->line($this->apply->user->name . "您好，" . $this->apply->camp_time->camp->name . '您已報名成功');

        if ($this->apply->offer->group) {
            $mail->line('您的隊伍名稱為：' . $this->apply->group->name)->line('您的隊伍ID為：' . $this->apply->group->id);
        }

        $mail->line("若您尚未轉帳，請儘速依照您提供的帳戶資訊轉帳")
            ->line("請使用： (" . $this->apply->bank_code . ")" . $this->apply->bank_account . " 轉帳")
            ->line("轉帳至： (" . $this->apply->camp_time->camp->bank_accounts->first()->code . ")" . $this->apply->camp_time->camp->bank_accounts->first()->account)
            ->line("繳費金額： " . $this->apply->offer->price)
            ->line("轉帳附註請加上這串ID： " . Str::substr($this->apply->id, Str::length($this->apply->id) - 6, 5))
            ->line('')
            ->line('再次感謝您使用營隊報名平台');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
