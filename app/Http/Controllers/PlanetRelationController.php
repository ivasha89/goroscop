<?php

namespace App\Http\Controllers;

use App\PlanetRelation;
use App\User;
use App\UsersRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsFalse;

class PlanetRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (UsersRelation::where('user_id'))
        $users = User::all();
        foreach ($users as $user) {

            if ($user->sex == 'm') {
                $man_id = $user->id;
                $man = $user;

                foreach ($users as $user) {

                    if ($user->sex == 'w') {
                        $woman = $user;
                        $woman_id = $user->id;
                        $countPlanet = 0;

                        foreach ($man->planets as $manPlanet) {
                            if ($manPlanet->planet_name == 'Кету')
                                break;
                            $countMatch = 0;
                            foreach ($woman->planets as $womanPlanet) {
                                if ($manPlanet->planet_name == $womanPlanet->planet_name) {
                                    $relation = PlanetRelation::where('man_sign', $manPlanet->planet_zodiac_sign)
                                        ->where('woman_sign', $womanPlanet->planet_zodiac_sign)
                                        ->select('count_planet', 'strength')
                                        ->get();
                                    if (empty($relation->first())) {
                                        $relation = PlanetRelation::where('woman_sign', $manPlanet->planet_zodiac_sign)
                                            ->where('man_sign', $womanPlanet->planet_zodiac_sign)
                                            ->select('count_planet')
                                            ->get();
                                    }
                                    $countMatch = $countMatch + $relation->first()['count_planet'];
                                }
                                if ($womanPlanet->planet_name == 'Раху')
                                    break;
                            }
                            $countPlanet = $countPlanet + $countMatch;
                        }
                        if ( empty (UsersRelation::where('user_id', $man_id)->where('woman_id', $woman_id)->get()->first())) {
                            UsersRelation::create([
                                'user_id' => $man_id,
                                'woman_id' => $woman_id,
                                'planets_match' => $countPlanet
                            ]);
                        }
                    }
                }
            }
        }
        return view('compare.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
