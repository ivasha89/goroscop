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
            $matches = UsersRelation::whereUser_id($user->id)->orderBy('planets_match', 'desc')->get();

            for ($j = 8; $j > -1; --$j)
                $maxNumberPlanetsMatch[$j] = count(UsersRelation::whereUser_id($user->id)->wherePlanets_match($j)->get());
            foreach ($matches as $match)
                $match->otherSexUser_id = $match->woman_id;
        }
        else {
            $matches = UsersRelation::whereWoman_id($user->id)->orderBy('planets_match', 'desc')->get();

            for ($j = 8; $j > -1; --$j)
                $maxNumberPlanetsMatch[$j] = count(UsersRelation::whereWoman_id($user->id)->wherePlanets_match($j)->get());
            foreach ($matches as $match)
                $match->otherSexUser_id = $match->user_id;
        }
        $matchesArray = $matches->toArray();

        for ($i = 0; $i < max($maxNumberPlanetsMatch); ++$i) {
            for ($j = 8; $j > -1; --$j) {
                for ($k = 0; $k < count($matchesArray); ++$k) {
                    if ($matchesArray[$k]['planets_match'] == $j) {
                        $otherSexUser = User::whereId($matchesArray[$k]['otherSexUser_id'])->get()->first();
                        $row[$j] = [
                            'name' => $otherSexUser['username'],
                            'id' => $matchesArray[$k]['id'],
                            'asc' => $otherSexUser['asc'],
                            'sex' => $otherSexUser['sex'],
                            'm' => $matchesArray[$k]['planets_match'],
                        ];
                        unset($matchesArray[$k]);
                        $matchesArray = array_values($matchesArray);
                        break;
                    }
                }
            }
            $array[$i] = $row;
            unset($row);
        }

        return view('users.compare', compact('user','array'));
    }

    /**
     * Show the form for creating a new resource.
     * @param UsersRelation $usersRelation
     * @return \Illuminate\Http\Response
     */
    public function showMore(UsersRelation $usersRelation)
    {
        $matchesObject = UsersRelation::orderBy('planets_match', 'desc')->get();
        $matchesArray = $matchesObject->toArray();

        for ($j = 8; $j > -1; --$j)
            $maxNumberPlanetsMatch[$j] = count(UsersRelation::wherePlanets_match($j)->get());

            for ($i = 0; $i < max($maxNumberPlanetsMatch); ++$i) {
                for ($j = 8; $j > -1; --$j) {
                    for ($k = 0; $k < count($matchesArray); ++$k) {
                        if ($matchesArray[$k]['planets_match'] == $j) {
                            $woman = User::whereId($matchesArray[$k]['woman_id'])->get()->first();
                            $man = User::whereId($matchesArray[$k]['user_id'])->get()->first();
                            $row[$j] = [
                                'names' => $man['username'] . '+' . $woman['username'],
                                'id' => $matchesArray[$k]['id'],
                            ];
                            unset($matchesArray[$k]);
                            $matchesArray = array_values($matchesArray);
                            break;
                        }
                    }
                }
                $array[$i] = $row;
                unset($row);
            }

        return view('compare.showMore', compact('array'));
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
        $woman = User::where('id', $usersRelation->woman_id)->get()->first();

        $relationColor = [];
        for ($j = 0; $j < 9; ++$j)
        {
            $relation = PlanetRelation::where('man_sign', $usersRelation->user->planets[$j]->planet_zodiac_sign)
                ->where('woman_sign', $woman->planets[$j]->planet_zodiac_sign)
                ->select('color')
                ->get();
            if (empty($relation->first())) {
                $relation = PlanetRelation::where('woman_sign', $usersRelation->user->planets[$j]->planet_zodiac_sign)
                    ->where('man_sign', $woman->planets[$j]->planet_zodiac_sign)
                    ->select('color')
                    ->get();
            }
            $relationColor[$j] = $relation->first()['color'];
        }

        return view('compare.show', compact( 'usersRelation', 'woman', 'relationColor'));
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
