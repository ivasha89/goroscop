@extends('layout')

@section('title')
    {{ $user->username }}. Гороскоп
@endsection

@section('content')
    <div class="row mb-2">
        <div class="col-10 text-center align-self-center border bg-light rounded-pill" id="shadowjQ1">
            <p class="title">{{ $user->username }}</p>
        </div>

        <div class="col-2">
            Асцендент в ⤵
            <img src='{{ url("/svg/$user->sex$user->asc") }}.jpg' width="195" class="img-thumbnail rounded" alt="..." id="shadowjQ">
        </div>
    </div>
    <table class="table table-striped table-bordered shadow mb-2">
        <caption>
            Гороскоп Преданного
        </caption>
        <thead class="thead-light">
            <tr>
                @foreach($user->planets as $planet)
                    <th scope="col" class="h3 rounded text-center text-truncate">
                        {{ $planet->planet_name }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @for($j = 0; $j < count($user->planets); ++$j)
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
                @foreach($user->planets as $planet)
                    <td scope="row">
                        <form method="post" action="/devoutees/{{ $planet->id }}">
                            <div class="badge badge-info float-left">{{ $planet->planet_house }}</div>
                            <div class="badge float-right">
                                <img src='{{ url("/svg/$planet->planet_zodiac_sign") }}.jpg' width="50" class="img-thumbnail rounded shadow-sm" alt="...">
                            </div>
                        </form>
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
    <div class="d-flex">
        <div class="p-2">
            <a class="btn btn-outline-info" role="button" href='{{ url("/collection/$user->id") }}'>
                <span class="spinner-border spinner-border-sm d-none" role="status"
                      aria-hidden="true"></span>
                Все Совместимости</a>
        </div>
        <div class="p-2 ml-auto">
            <a class="btn btn-outline-info float-left" role="button" href='{{ url("/users/$user->id/edit") }}'>
                <span class="spinner-border spinner-border-sm d-none" role="status"
                      aria-hidden="true"></span>
                Изменить</a>
        </div>
    </div>
@endsection