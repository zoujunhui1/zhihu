<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{
    public function __construct(){
        $this->middleware('auth');//保证登录之后才能访问
    }

    public function follow($question){
        Auth::user()->followThis($question);
        return back();
    }
}
