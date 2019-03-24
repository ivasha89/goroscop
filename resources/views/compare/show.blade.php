@extends('layout')
@section('title')
    {{ $usersRelation->user['username'] }} +
    {{ $woman['username'] }}
@endsection
@section('content')
    <div class="row mb-2">
        <div class="col-4 text-center align-self-center border bg-light rounded-pill">
            <a href="/users/{{$usersRelation->user['id']}}" class="title">
                {{ $usersRelation->user['username'] }}
            </a>
        </div>

        <div class="col-2">
            Асцендент в ⤵
            <img src="/svg/{{ $usersRelation->user['sex'] }}{{ $usersRelation->user['asc'] }}.jpg" width="195" class="img-thumbnail rounded" alt="..."
                 id="shadowjQ">
        </div>
        <div class="col-2">
            Асцендент в ⤵
            <img src="/svg/{{ $woman['sex'] }}{{ $woman['asc'] }}.jpg" width="195" class="img-thumbnail rounded" alt="..."
                 id="shadowjQ1">
        </div>

        <div class="col-4 text-center align-self-center border bg-light rounded-pill">
            <a href="/users/{{ $woman['id'] }}" class="title">
                {{ $woman['username'] }}
            </a>
        </div>
    </div>
    <table class="table table-striped table-bordered shadow mb-2">
        <caption>
            Гороскоп Совместимости
        </caption>
        <thead class="thead-light">
        <tr>
            @for($j=0; $j<9; ++$j)
                <th scope="col" class="h3 rounded text-center text-truncate" style="background-color: {{ $relationColor[$j] }}">
                    {{ $usersRelation->user->planets[$j]->planet_name }}
                </th>
            @endfor
        </tr>
        </thead>
        <tbody>
        <tr>
            @for($j = 0; $j < count($usersRelation->user->planets); ++$j)
                <td>
                    <div class="badge badge-info text-wrap float-left">
                        Дом
                    </div>
                    <div class="d-none">
                        {{ $j }}
                    </div>
                    <div class="badge text-wrap bg-light shadow-sm float-right">
                        Знак
                    </div>
                </td>
            @endfor
        </tr>
        <tr>
            @foreach($usersRelation->user->planets as $planet)
                <form method="post" action="/devoutees/{{ $planet->id }}">
                    <td scope="row">
                        <div class="badge badge-info float-left">{{ $planet->planet_house }}</div>
                        <div class="badge float-right">
                            <img src="/svg/{{ $planet->planet_zodiac_sign }}.jpg" width="50"
                                 class="img-thumbnail rounded shadow-sm" alt="...">
                        </div>
                    </td>
                </form>
            @endforeach
        </tr>
        <tr>
            @foreach($woman->planets as $planet)
                <form method="post" action="/devoutees/{{ $planet->id }}">
                    <td scope="row">
                        <div class="badge badge-info float-left">{{ $planet->planet_house }}</div>
                        <div class="badge float-right">
                            <img src="/svg/{{ $planet->planet_zodiac_sign }}.jpg" width="50"
                                 class="img-thumbnail rounded shadow-sm" alt="...">
                        </div>
                    </td>
                </form>
            @endforeach
        </tr>
        </tbody>
    </table>
@endsection