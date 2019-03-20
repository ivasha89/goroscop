@extends('layout')

@section('content')
<div class="table-responsive">
    <table class="table table-bordered shadow">
        <thead>
        <tr>
            <th class="h5" scope="col">
                Матаджи \ Прабху
            </th>
            @foreach($users as $user)
                @if($user->sex == 'w')
                    <th scope="col">
                            <a href="/users/{{ $user->id }}">
                                <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" width="95"
                                     class="img-thumbnail rounded" alt="...">
                                <p>
                                    {{ $user->username }}
                                </p>
                            </a>
                    </th>
                @endif
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if($user->sex == 'm')
                <tr>
                    <th scope="row">
                            <a href="/users/{{ $user->id }}" class="links">
                                <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" width="95"
                                     class="img-thumbnail rounded" alt="...">
                                <p>
                                    {{ $user->username }}
                                </p>
                            </a>
                    </th>
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
        </tbody>
    </table>
</div>
@endsection