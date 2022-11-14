<?php

namespace App\Notifications;

use App\Models\Camp;
use App\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CampApplyNotice extends Notification {
    use Queueable;

    public Camp $camp;
    public Group $group;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Camp $camp, Group $group = null) {
        $this->camp = $camp;
        $this->group = $group;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $mail = (new MailMessage)
            ->subject('營隊報名結果')
            ->line($this->camp->name . '報名成功');

        if ($this->group) {
            $mail->line('您的隊伍名稱為：' . $this->group->name)->line('您的隊伍ID為：' . $this->group->id);
        }

        $mail->line("請儘速依照您提供的帳戶資訊轉帳")
            ->line('感謝您使用營隊報名平台');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
