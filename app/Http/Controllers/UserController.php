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
            'sex' => ['required', 'min:1'],
            'asc' => ['min:1', 'max:2'],
            'moon' => ['min:1', 'max:2'],
            'moon_house' => ['min:1', 'max:2'],
            'sun' => ['min:1', 'max:2'],
            'sun_house' => ['min:1', 'max:2'],
            'mercury' => ['min:1', 'max:2'],
            'mercury_house' => ['min:1', 'max:2'],
            'vinus' => ['min:1', 'max:2'],
            'vinus_house' => ['min:1', 'max:2'],
            'mars' => ['min:1', 'max:2'],
            'mars_house' => ['min:1', 'max:2'],
            'jupiter' => ['min:1', 'max:2'],
            'jupiter_house' => ['min:1', 'max:2'],
            'saturn' => ['min:1', 'max:2'],
            'saturn_house' => ['min:1', 'max:2'],
            'rahu' => ['min:1', 'max:2'],
            'rahu_house' => ['min:1', 'max:2']
        ]);
        User::create([
            'username' => $request->username,
            'sex' => $request->sex,
            'asc' =>$request->asc
        ]);

        $user_id = User::where('username', $request->username)->select('id')->get();

        $planets = [
            'Луна' => 'moon', 'Солнце' => 'sun', 'Меркурий' => 'mercury', 'Венера' => 'vinus', 'Марс' => 'mars', 'Юпитер' => 'jupiter', 'Сатурн' => 'saturn', 'Раху' => 'rahu', 'Кету' => 'ketu'
        ];

        foreach ($planets as $key => $planet) {
            $planet_house = $planet . '_house';
            Devoutee::create([
                'user_id' => $user_id->first()->id,
                'planet_zodiac_sign' => $request->$planet,
                'planet_house' => $request->$planet_house,
                'planet_name' => $key
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
                'asc' => ['min:1'],
            ]);

            DB::table('users')
                ->where('username', $user->username)
                ->update([
                    'username' => $request->username,
                    'sex' => $request->sex,
                    'asc' => $request->asc
                ]);
        }

        for ($j = 0; $j < count($user->planets); ++$j)
        {
            if ($user->planets[$j]->planet_name == $request->keys()['2']) {
                $post_planet_name = $user->planets[$j]->planet_name;
                $post_planet_house = $user->planets[$j]->planet_name . '_house';

                $request->validate([
                    $post_planet_name => ['min:1', 'max:2'],
                    $post_planet_house => ['min:1', 'max:2'],
                ]);

                DB::table('devoutees')
                    ->where('planet_name', $request->keys()['2'])
                    ->where('user_id', $user->id)
                    ->update([
                        'planet_zodiac_sign' => $request->$post_planet_name,
                        'planet_house' => $request->$post_planet_house,
                    ]);
            }
        }
        $otherSexUsers = User::where('sex', '!=', $user->sex)->get();
        foreach($otherSexUsers as $otherSexUser)
        {
            $countPlanet = 0;
            foreach ($user->planets as $userPlanet) {
                if ($userPlanet->planet_name == 'Кету')
                    break;
                $countMatch = 0;
                foreach ($otherSexUser->planets as $otherSexUserPlanet) {
                    if ($userPlanet->planet_name == $otherSexUserPlanet->planet_name) {
                        $relation = PlanetRelation::where('man_sign', $userPlanet->planet_zodiac_sign)
                            ->where('woman_sign', $otherSexUserPlanet->planet_zodiac_sign)
                            ->select('count_planet', 'strength')
                            ->get();
                        if (empty($relation->first())) {
                            $relation = PlanetRelation::where('woman_sign', $userPlanet->planet_zodiac_sign)
                                ->where('man_sign', $otherSexUserPlanet->planet_zodiac_sign)
                                ->select('count_planet')
                                ->get();
                        }
                        $countMatch = $countMatch + $relation->first()['count_planet'];
                    }
                    if ($otherSexUserPlanet->planet_name == 'Раху')
                        break;
                }
                $countPlanet = $countPlanet + $countMatch;
            }
            if ($user->sex == 'm')
                UsersRelation::where('user_id', $user->id)
                    ->where('woman_id', $otherSexUser->id)
                    ->update([
                    'planets_match' => $countPlanet
                ]);
            else
                UsersRelation::where('woman_id', $user->id)
                    ->where('user_id', $otherSexUser->id)
                    ->update([
                        'planets_match' => $countPlanet
                    ]);
        }

        return view('users.edit', compact('user'));
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