@extends('layout')

@section('title', 'Таблица совместимых планет')

@section('content')
    <table class="table table-striped table-bordered shadow mb-2">
        <caption>
            Таблица Совместимостей
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
                            <div class="text-center text-break border-dark">
                                <a href='{{ url("/compare/".$row[$j]['id']."") }}' class="links">
                                    {{ $row[$j]['names'] }}
                                </a>
                            </div>
                        @endif
                    </td>
                @endfor
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection