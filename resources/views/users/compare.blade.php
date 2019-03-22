@extends('layout')

@section('content')
    <h1 class="title"> {{ $user->username }} </h1>
    <table class="table table-striped table-bordered shadow mb-2">
        <caption>
            Совместимости Преданного
        </caption>
        <thead class="thead-light">
        <tr>
            @for ($j=8; $j>-1; --$j)
                <th scope="col" class="h3 rounded text-center">
                    {{ $j }}
                </th>
            @endfor
        </tr>
        </thead>
        <tbody>
        @while(!empty($matches->first()))
        <tr>
            @for ($j=8; $j>-1; --$j)
                <td>
                @foreach($matches as $k => $match)
                    @if($match->planets_match == $j)
                        @foreach($otherSexUsers as $otherSexUser)
                            @if($otherSexUser->id == $match->otherSexUser_id)

                                    <a href="/compare/{{ $match->id }}" class="links">
                                        <div class="d-flex justify-content-center">
                                            <img src="/svg/{{ $otherSexUser->sex }}{{ $otherSexUser->asc }}.jpg" width="95" class="img-thumbnail rounded" alt="...">
                                        </div>
                                        <div class="text-center text-truncate">
                                            {{$otherSexUser->username}}
                                        </div>
                                        @php
                                            unset($matches[$k]);
                                            break
                                        @endphp
                                    </a>

                            @endif
                        @endforeach
                    @endif
                @endforeach
                    </td>
            @endfor
        </tr>
        @endwhile
        </tbody>
    </table>
@endsection