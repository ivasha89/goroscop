@extends('layout')
@section('title', 'Добро Пожаловать')
@section('content')
    <div class="jumbotron mb-2 bg-light">
        <h1 class="display-4">Добро пожаловать на рабочее место</h1>
        <div class="row">
            <div class="col-12">
                <p class="lead">Количество преданных в базе:{{ $allUsers }}</p>
            </div>
            <div class="col-12">
                <table class="table table-striped table-bordered shadow mb-2">
                    <caption>
                        Общая статистика
                    </caption>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" class="rounded" style="width: 11em;">
                            Количество совпадающих планет
                        </th>
                        @for ($j=8; $j>-1; --$j)
                            <th scope="col" class="h3 rounded text-center">
                                {{ $j }}
                            </th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col" class="rounded text-break">
                                Количество пар
                            </td>
                            @for ($j=8; $j>-1; --$j)
                                <td>
                                    <div class="text-center text-break border-dark">
                                        {{ $matchesCount[$j] }}
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-4">
        <p>Начать работу можно здесь</p>
        <a class="btn btn-primary btn-lg" href="{{ url('/users') }}" role="button">Общая таблица</a>
    </div>
@endsection
