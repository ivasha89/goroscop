@extends('layout')

@section('content')
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
                                @foreach($users as $man)
                                    @if($man->id == $match->user_id)
                                        @foreach($users as $woman)
                                            @if($woman->id == $match->woman_id)
                                                <div class="text-center text-break border-dark">
                                                    <a href="/compare/{{ $match->id }}" class="links">
                                                        {{ $man->username }} +
                                                        {{ $woman->username }}
                                                    </a>
                                                    @php
                                                        unset($matches[$k]);
                                                        break
                                                    @endphp
                                                </div>
                                            @endif
                                        @endforeach
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