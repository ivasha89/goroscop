@extends('layout')

@section('content')
    <table class="table table-striped table-bordered shadow">
        <tr class="sticky-top">
            <td class="col-1 h5">
                Прабху\Матаджи
            </td>
            @foreach($users as $user)
                @if($user->sex == 'w')
                    <td class="col-3">
                        <a href="/users/{{ $user->id }}">
                            {{ $user->username }}
                        </a>
                    </td>
                @endif
            @endforeach
        </tr>
        @foreach($users as $user)
            @if($user->sex == 'm')
                <tr>
                    <td>
                        <a href="/users/{{ $user->id }}">
                            {{ $user->username }}
                        </a>
                    </td>
                    @foreach($user->matches as $match)
                        <td>
                            <a href="/compare/{{ $match->id }}">
                                {{ $match->planets_match }}
                            </a>
                        </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
    </table>
@endsection