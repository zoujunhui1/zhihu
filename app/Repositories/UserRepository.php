<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/9
 * Time: 10:09
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function byId($id){
        return User::find($id);
    }

}