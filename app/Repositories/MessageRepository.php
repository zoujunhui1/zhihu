<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12
 * Time: 10:31
 */

namespace App\Repositories;


use App\Message;

class MessageRepository
{
    public function create(array $attributes){
        return Message::create($attributes);
    }
}