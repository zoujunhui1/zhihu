<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/28
 * Time: 15:17
 */

namespace App\Repositories;


use App\Answer;

class AnswerRepository {

    public function create(array $attributes){
        return Answer::create($attributes);
    }
}