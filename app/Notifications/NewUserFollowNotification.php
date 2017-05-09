<?php

namespace App\Notifications;

use App\Channels\SendcloudChannel;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Naux\Mail\SendCloudTemplate;
use Mail;
class NewUserFollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notifications instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notifications's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',SendcloudChannel::class];
    }

    public function toSendcloud($notifiable){
        $data = ['url' =>'http://zhihu-dev.com/','name'=>Auth::guard('api')->user()->name];
        $template = new SendCloudTemplate('zhihu_app_new_user_follow', $data);
        Mail::raw($template, function ($message) use ($notifiable){
            $message->from('junhuizoujh@163.com', 'zou');//邮件发送人和用户名
            $message->to($notifiable->email);//接受邮件的用户
        });
    }

    public function toDatabase(){
        return [
            'name'=>Auth::guard('api')->user()->name,
        ];
    }

    /**
     * Get the array representation of the notifications.
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
}
