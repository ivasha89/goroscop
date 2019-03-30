<?php

namespace App\Http\Controllers;

use App\User;
use App\UsersRelation;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome ()
    {
        $tkn = session('tkn');
        $users = User::all();
        $allUsers = count($users);
        $matches = [];
        for($j=8; $j >-1; --$j){
            $matches[$j] = UsersRelation::where('planets_match', $j)->get();
            $matchesCount[$j] = count($matches[$j]);
        }
        return view('welcome', compact('allUsers', 'matchesCount', 'tkn'));
    }

    public static function store(Request $request)
    {
        if ($request->has('psrd'))
        {
            $secretWord = 'astronomy';
            $pass = $request->psrd;
            if ($pass == $secretWord)
                $tkn = TRUE;
            else
                $tkn = FALSE;
            $request->session()->put('tkn', $tkn);
            if ($tkn)
                return redirect('/welcome');
            else
                return redirect('/');
        }
    }

    public function check()
    {
        if (session('tkn'))
            session()->forget('tkn');
            
        return view('layout');
    }
}
