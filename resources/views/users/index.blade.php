@extends('layout')

@section('content')
<div class="table-responsive">
    <table class="table table-bordered shadow">
        <tr>
            <td class="h5 text-break">
                Матаджи \ Прабху
            </td>
            @foreach($users as $user)
                @if($user->sex == 'w')
                    <td>
                        <div class="text-center">
                            <a href="/users/{{ $user->id }}" class="links">
                                <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" width="95"
                                     class="img-thumbnail rounded" alt="..." id="shadowjQ">
                                <div class="text-break">
                                    {{ $user->username }}
                                </div>
                            </a>
                        </div>
                    </td>
                @endif
            @endforeach
        </tr>
        @foreach($users as $user)
            @if($user->sex == 'm')
                <tr>
                    <td>
                        <div class="text-center">
                        <a href="/users/{{ $user->id }}" class="links">
                            <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" width="95"
                                 class="img-thumbnail rounded" alt="..." id="shadowjQ">
                            <div>
                                {{ $user->username }}
                            </div>
                        </a>
                        </div>
                    </td>
                    @foreach($user->matches as $match)
                        <td>
                            <div class="text-center align-content-center">
                                <a href="/compare/{{ $match->id }}">
                                    {{ $match->planets_match }}
                                </a>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
    </table>
</div>
@endsection