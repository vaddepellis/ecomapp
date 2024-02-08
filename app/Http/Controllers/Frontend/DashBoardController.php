<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function home(){
        return view('home');
    }
    public function register(){
        return view('register');
    }
}
