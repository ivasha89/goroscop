@extends('layout')

@section('title')
   {{ $user->username }}
@endsection

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
        @foreach ($array as $row)
        <tr>
            @for ($j=8; $j>-1; --$j)
                <td>
                    @if(isset($row[$j]))
                        <a href="/compare/{{ $row[$j]['id'] }}" class="links">
                            <div class="d-flex justify-content-center">
                                <img src="/svg/{{ $row[$j]['sex'] }}{{ $row[$j]['asc'] }}.jpg" width="95" class="img-thumbnail rounded" alt="...">
                            </div>
                            <div class="text-center text-truncate">
                                {{ $row[$j]['name'] }}
                            </div>
                        </a>
                    @endif
                </td>
            @endfor
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection