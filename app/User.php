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
        'name', 'email', 'password','avatar','comfirmation_token','api_token'
    ];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function owns(Model $model){
        return $this->id == $model->user_id;
    }

    public function follows(){
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }

    public function followThis($question){
        return $this->follows()->toggle($question);
    }

    public function followed($question){
        return !!$this->follows()->where('question_id',$question)->count();
    }

    public function followers(){
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    public function followersUser(){
        return $this->belongsToMany(self::class,'followers','followed_id','follower_id')->withTimestamps();
    }

    public function followThisUser($user){
        return $this->followers()->toggle($user);
    }

    public function votes(){
        return $this->belongsToMany(Answer::class,'votes')->withTimestamps();
    }

    public function voteFor($answer){
        return $this->votes()->toggle($answer);
    }

    public function hasVotedFor($answer){
        return !! $this->votes()->where('answer_id',$answer)->count();
    }

    public function message(){
        return $this->hasMany(Message::class,'to_user_id');
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
