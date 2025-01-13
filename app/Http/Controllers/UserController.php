<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bezeroa;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       
        $users = User::get();

        
        return view('welcome', compact('users'));
    }
}

