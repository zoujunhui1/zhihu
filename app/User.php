<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Naux\Mail\SendCloudTemplate;
use Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','comfirmation_token'
    ];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function owns(Model $model){
        return $this->id == $model->user_id;
    }

    public function follows($question){
        return Follow::create([
           'question_id'=>$question,
            'user_id'=>$this->id
        ]);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token){
        $data = ['url' => url('password/reset', $token),];
        $template = new SendCloudTemplate('zhihu_app_password_reset', $data);
        Mail::raw($template, function ($message) {
            $message->from('junhuizoujh@163.com', 'zou');//邮件发送人和用户名
            $message->to($this->email);//接受邮件的用户
        });
    }
}
