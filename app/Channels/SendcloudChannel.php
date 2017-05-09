<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/9
 * Time: 17:51
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SendcloudChannel
{
    public function send($notifiable,Notification $notification){
        $message = $notification->toSendcloud($notifiable);
    }
}