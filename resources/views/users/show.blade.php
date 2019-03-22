@extends('layout')

@section('content')
    <div class="row mb-2">
        <div class="col-10 text-center align-self-center border bg-light rounded-pill">
            <p class="title">{{ $user->username }}</p>
        </div>

        <div class="col-2">
            Асцендент в ⤵
            <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" width="195" class="img-thumbnail rounded" alt="..." id="shadowjQ">
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
                                <img src="/svg/{{ $planet->planet_zodiac_sign }}.jpg" width="50" class="img-thumbnail rounded shadow-sm" alt="...">
                            </div>
                        </form>
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
        <div class="col-2">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/collection/{{ $user->id }}">
                        <span class="spinner-border spinner-border-sm d-none" role="status"
                              aria-hidden="true"></span>
                        Все Совместимости</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/users/{{ $user->id }}/edit">
                        <span class="spinner-border spinner-border-sm d-none" role="status"
                              aria-hidden="true"></span>
                        Изменить</a>
                </li>
            </ul>
        </div>
@endsection