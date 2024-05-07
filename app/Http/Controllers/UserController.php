<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function index(){
        return view('home', [
            "title" => "home",
            'user' => User::all()
        ]);

    }
}
