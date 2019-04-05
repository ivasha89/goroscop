<?php

namespace App\Http\Controllers;

use App\User;
use App\Devoutee;
use App\PlanetRelation;
use App\UsersRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planets = [
            'Луна' => 'moon', 'Солнце' => 'sun', 'Меркурий' => 'mercury', 'Венера' => 'vinus', 'Марс' => 'mars', 'Юпитер' => 'jupiter', 'Сатурн' => 'saturn', 'Раху' => 'rahu', 'Кету' => 'ketu'
        ];
        return view('users.create', compact('planets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'sex' => ['required'],
            'asc' => ['gt: 0', 'lt: 13']
        ]);

        $planets = [
            'Луна' => 'moon', 'Солнце' => 'sun', 'Меркурий' => 'mercury', 'Венера' => 'vinus', 'Марс' => 'mars', 'Юпитер' => 'jupiter', 'Сатурн' => 'saturn', 'Раху' => 'rahu', 'Кету' => 'ketu'
        ];
        foreach($planets as $planet) {
            $request->validate([
                $planet => ['gt: 0', 'lt: 13'],
                $planet.'_house' => ['gt: 0', 'lt: 13'],
            ]);
        }
        User::create([
            'username' => $request->username,
            'sex' => $request->sex,
            'asc' =>$request->asc
        ]);

        $user = User::where('username', $request->username)->get()->first();

        foreach ($planets as $key => $planet) {
            $planet_house = $planet . '_house';
            Devoutee::create([
                'user_id' => $user->id,
                'planet_zodiac_sign' => $request->$planet,
                'planet_house' => $request->$planet_house,
                'planet_name' => $key
            ]);
        }

        $otherSexUsers = User::where('sex', '!=', $request->sex)->get();

        foreach ($otherSexUsers as $otherSexUser) {
            $countPlanet = 0;
            for ($j = 0; $j < count($otherSexUser->planets) - 1; ++$j) {
                $relation = PlanetRelation::where('man_sign', $user->planets[$j]->planet_zodiac_sign)
                    ->where('woman_sign', $otherSexUser->planets[$j]->planet_zodiac_sign)
                    ->select('count_planet')
                    ->get();
                if (empty($relation->first()))
                    $relation = PlanetRelation::where('woman_sign', $user->planets[$j]->planet_zodiac_sign)
                        ->where('man_sign', $otherSexUser->planets[$j]->planet_zodiac_sign)
                        ->select('count_planet')
                        ->get();
                $countPlanet = $countPlanet + $relation->first()['count_planet'];
            }
            if ($request->sex == 'm')
                UsersRelation::create([
                    'user_id' => $user->id,
                    'woman_id' => $otherSexUser->id,
                    'planets_match' => $countPlanet
                ]);
            else
                UsersRelation::create([
                    'woman_id' => $user->id,
                    'user_id' => $otherSexUser->id,
                    'planets_match' => $countPlanet
                ]);
        }

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->has('username'))
        {
            $request->validate([
                'username' => ['string', 'max:255'],
                'sex' => ['min:1'],
                'asc' => ['gt: 0', 'lt: 13'],
            ]);

            DB::table('users')
                ->where('username', $user->username)
                ->update([
                    'username' => $request->username,
                    'sex' => $request->sex,
                    'asc' => $request->asc
                ]);
        }
        else {
            $post_planet_name = $request->keys()['2'];
            $post_planet_house = $request->keys()['2'] . '_house';

            $request->validate([
                $post_planet_name => ['gt: 0', 'lt: 13'],
                $post_planet_house => ['gt: 0', 'lt: 13'],
            ]);

            DB::table('devoutees')
                ->where('planet_name', $request->keys()['2'])
                ->where('user_id', $user->id)
                ->update([
                    'planet_zodiac_sign' => $request->$post_planet_name,
                    'planet_house' => $request->$post_planet_house,
                ]);
        }
        $otherSexUsers = User::where('sex', '!=', $request->sex)->get();

        foreach ($otherSexUsers as $otherSexUser) {
            $countPlanet = 0;
            for ($j = 0; $j < count($user->planets) - 1; ++$j) {
                $relation = PlanetRelation::where('man_sign', $user->planets[$j]->planet_zodiac_sign)
                    ->where('woman_sign', $otherSexUser->planets[$j]->planet_zodiac_sign)
                    ->select('count_planet')
                    ->get();
                if (empty($relation->first()))
                    $relation = PlanetRelation::where('woman_sign', $user->planets[$j]->planet_zodiac_sign)
                        ->where('man_sign', $otherSexUser->planets[$j]->planet_zodiac_sign)
                        ->select('count_planet')
                        ->get();
                $countPlanet = $countPlanet + $relation->first()['count_planet'];
            }
            if ($user->sex == 'm') {
                if ($request->keys()['2'] !== 'username')
                    UsersRelation::where('user_id', $user->id)
                        ->where('woman_id', $otherSexUser->id)
                        ->update([
                            'planets_match' => $countPlanet
                        ]);
                elseif ($request->sex !== $user->sex) {
                    UsersRelation::where('user_id', $user->id)
                        ->delete();
                    UsersRelation::create([
                        'user_id' => $otherSexUser->id,
                        'woman_id' => $user->id,
                        'planets_match' => $countPlanet
                    ]);
                }
            }
            else {
                if ($request->keys()['2'] !== 'username')
                    UsersRelation::where('woman_id', $user->id)
                        ->where('user_id', $otherSexUser->id)
                        ->update([
                            'planets_match' => $countPlanet
                        ]);
                elseif ($request->sex !== $user->sex) {
                    UsersRelation::where('woman_id', $user->id)
                        ->delete();
                    UsersRelation::create([
                        'user_id' => $user->id,
                        'woman_id' => $otherSexUser->id,
                        'planets_match' => $countPlanet
                    ]);
                }
            }
        }

        return redirect("users/{$user->id}");
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $planets = $user->planets;
        foreach($planets as $planet) {
            $planet->delete();
        }

        $matches = $user->matches;
        foreach( $matches as $match){
            $match->delete();
        }
        return redirect('/users');
    }
}