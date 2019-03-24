<?php

namespace App\Http\Controllers;

use App\User;
use App\UsersRelation;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome ()
    {
        $users = User::all();
        $allUsers = count($users);
        $matches = [];
        for($j=8; $j >-1; --$j){
            $matches[$j] = UsersRelation::where('planets_match', $j)->get();
            $matchesCount[$j] = count($matches[$j]);
        }
        return view('welcome', compact('allUsers', 'matchesCount'));
    }
}
