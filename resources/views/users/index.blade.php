@extends('layout')
@section('title', 'Главная таблица')
@section('content')
    <table class="table table-bordered shadow">
        <thead>
        <tr class="table-danger">
            <th scope="col" class="bg-light border-secondary" style="width: 11em;">
                <div class="row">
                    <div class="col-9">
                        <div class="mb-3">
                            <img style="height: 100px;" src="/svg/name.jpg" class="img-thumbnail rounded" alt="...">
                        </div>
                        <div style="letter-spacing: 12px" class="font-weight-normal">
                             Прабху
                        </div>
                    </div>
                    <div class="col-3 text-break font-weight-normal" style="width: 1em; font-size: small ">Матаджи</div>
                </div>
            </th>
            @foreach($users as $user)
                @if($user->sex == 'w')
                    <th scope="col" class="sticky-top border-white" style="width: 11em;">
                        <div class="text-center">
                            <a href="/users/{{ $user->id }}" class="links">
                                <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" width="95"
                                     class="img-thumbnail rounded" alt="...">
                                <div class="text-break">
                                    {{ $user->username }}
                                </div>
                            </a>
                        </div>
                    </th>
                @endif
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if($user->sex == 'm')
                <tr>
                    <td class="sticky-left table-warning">
                        <div class="text-center">
                        <a href="/users/{{ $user->id }}" class="links">
                            <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" width="95"
                                 class="img-thumbnail rounded" alt="...">
                            <div>
                                {{ $user->username }}
                            </div>
                        </a>
                        </div>
                    </td>
                    @foreach($user->matches as $match)
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="/compare/{{ $match->id }}">
                                    {{ $match->planets_match }}
                                </a>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection