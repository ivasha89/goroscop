@extends('layout')

@section('title')
    @if($errors->any())
        Ошибки ввода
    @else
        Ввод даннах
    @endif
@endsection

@section('content')
    <form action="/users" method="post">
        @csrf
        <div class="table-responsive mb-2">
            <table class="table table-bordered shadow mb-2">
                <thead class="thead-dark">
                    <tr>
                        @foreach($planets as $key => $planet)
                            <th scope="col" class="h3 rounded text-center text-truncate">
                                {{ $key }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($planets as $key => $planet)
                            <td>
                                <div class="form-group">
                                    <label for="{{ $planet }}">
                                        Знак Зодиака
                                    </label>
                                    <input type="text" class="form-control" name="{{ $planet }}" id="{{ $planet }}"
                                           placeholder="{{ old($planet) }}">
                                </div>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($planets as $key => $planet)
                            <td>
                                <div class="form-group">
                                    <label for="{{ $planet }}1">
                                        Дом
                                    </label>
                                    <input type="text" class="form-control"
                                           name="{{ $planet }}_house"
                                           id="{{ $planet }}1"
                                           value="{{ old($planet.'_house') }}">
                                </div>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="row">
            <div class="col-6"></div>
            <div class="col-3">
                <div class="form-group">
                    <label class="text-info" for="username">Имя преданного</label>
                    <input type="text" class="form-control" name="username"
                           placeholder="{{ old('username') }}">
                </div>
                <div class="float-right">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sex">Пол преданного</label>
                            <select class="custom-select" name="sex" id="sex">
                                <option value="w">ж</option>
                                <option value="m">м</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group ">
                    <label for="asc">Асцендент преданного</label>
                    <input type="text" class="form-control" name="asc" id="asc"
                           placeholder="{{ old('asc') }}">
                </div>
                <button type="submit" class="btn btn-outline-info mb-2 float-right">
                    <span class="spinner-border spinner-border-sm d-none" role="status"
                          aria-hidden="true"></span>
                    Сохранить
                </button>
            </div>
        </div>

    <div class="card-footer">
        <h5 class="text-right">
            Готово
        </h5>
    </div>

    </form>
@endsection