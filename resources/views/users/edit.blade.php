@extends('layout')

@section('content')
        <div class="row p-2">
            <div class="col-3">
                <div class="card text-center">
                    <div class="card-header">
                        <h2 class="btn mb-0">
                            Изменить данные
                        </h2>
                    </div>
                        <form action="/users/{{$user->id}}" method="post" class="mb-2">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="text-info" for="username">Имя преданного</label>
                                    <input type="text" class="form-control" name="username"
                                           value="{{ $user->username }}">
                                </div>

                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <label class="text-info input-group-text" for="sex">Пол преданного</label>
                                        <select class="custom-select" name="sex">
                                            @if( $user->sex == 'w')
                                                <option value="w">ж</option>
                                                <option value="m">м</option>
                                            @else
                                                <option value="m">м</option>
                                                <option value="w">ж</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-info" for="asc">Асцендент преданного</label>
                                    <input type="text" class="form-control" name="asc"
                                           value="{{ $user->asc }}">
                                </div>
                            </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-info">Обновить</button>
                        </div>
                        </form>
                        <form method="post" action="/users/{{ $user->id }}">
                            @method('DELETE')
                            @csrf
                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-info">Удалить</button>
                            </div>
                        </form>
                    </div>
            </div>


            <div class="col-3">
                <div class="accordion" id="accordionExample">
                    @foreach($user->planets as $planet)
                        <div class="card text-center">
                            <div class="card-header" id="{{ $planet->planet_name }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{ $planet->planet_name  }}1" aria-expanded="true" aria-controls="{{ $planet->planet_name }}1">
                                        {{ $planet->planet_name }}
                                    </button>
                                </h2>
                            </div>

                            <div id="{{ $planet->planet_name  }}1" class="collapse hide" aria-labelledby="{{ $planet->planet_name }}" data-parent="#accordionExample">
                                <form action="/users/{{$user->id}}" method="post" class="mb-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="text-info" for="{{ $planet->planet_name }}">Знак Зодиака Планеты</label>
                                            <input type="text" class="form-control" name="{{ $planet->planet_name }}"
                                                   value="{{ $planet->planet_zodiac_sign }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="text-info" for="{{ $planet->planet_name }}">Дом Планеты</label>
                                            <input type="text" class="form-control" name="{{ $planet->planet_name }}_house" value="{{ $planet->planet_house }}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-outline-info">Обновить</button>
                                    </div>
                                </form>
                                <form method="post" action="/users/{{ $user->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-outline-info">Удалить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-5 ml-auto">
                <img src="/svg/{{ $user->sex }}{{ $user->asc }}.jpg" class="img-thumbnail rounded" alt="..." id="shadowjQ">
            </div>
        </div>
@endsection