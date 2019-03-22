<?php

namespace App\Http\Controllers;

use App\PlanetRelation;
use App\User;
use App\UsersRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsFalse;

class PlanetRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if ($user->sex == 'm') {
            $otherSexUsers = User::where('sex', 'w')->get();
            $matches = UsersRelation::where('user_id', $user->id)->orderBy('planets_match', 'desc')->get();
            foreach ($matches as $match)
                $match->otherSexUser_id = $match->woman_id;
        }
        else {
            $otherSexUsers = User::where('sex', 'm')->get();
            $matches = UsersRelation::where('woman_id', $user->id)->orderBy('planets_match', 'desc')->get();
            foreach ($matches as $match)
                $match->otherSexUser_id = $match->user_id;
        }

        return view('users.compare', compact('user', 'otherSexUsers', 'matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMore()
    {
            $users = User::all();
            $matches = UsersRelation::orderBy('planets_match', 'desc')->get();

        return view('compare.showMore', compact('users', 'matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param  \App\UsersRelation $usersRelation
     * @return \Illuminate\Http\Response
     */
    public function show(UsersRelation $usersRelation)
    {
        return view('compare.show', compact( 'usersRelation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlanetRelation  $planetRelation
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanetRelation $planetRelation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlanetRelation  $planetRelation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanetRelation $planetRelation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlanetRelation  $planetRelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanetRelation $planetRelation)
    {
        //
    }
}
