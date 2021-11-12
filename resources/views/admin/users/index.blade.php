@extends('layouts.master')

@section('title', 'Всички потребители')

@section('content')
    <div class="container">
        <h1 class="ml-2">@yield('title')</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Име</th>
                <th>Емайл</th>
                <th>Админ</th>
                <th>Добави вид гориво</th>
                <th>Добави тип път</th>
                <th>Създаден на</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
{{--                <th>Запази</th>--}}
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->admin == 0 ? 'Потребител' : 'Администратор' }}</td>
                        <td>
                          <div class="buttons">
                            <a href="{{route('admin.fuels.create')}}"><button type="submit" class="button is-info">Добави</button></a>
                            <a href="{{route('admin.fuels.index')}}"><button type="submit" class="button is-warning">Прегледай</button></a>
                          </div>
                        </td>
                        <td>
                          <div class="buttons">
                            <a href="{{route('admin.road_types.create')}}"><button type="submit" class="button is-info">Добави</button></a>
                            <a href="{{route('admin.road_types.index')}}"><button type="submit" class="button is-warning">Прегледай</button></a>
                          </div>
                        </td>
                        <td> {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        <td>
                            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="select">
                                    <label for="admin">
                                        <select id="admin" name="admin">
                                            <option value="1" {{ $user->admin ? 'selected' : '' }}>Администратор</option>
                                            <option value="0" {{ !$user->admin ? 'selected' : '' }}>Потребител</option>
                                        </select>
                                    </label>
                                </div>

                                <button type="submit" class="button is-success mt-2">Запази</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="button is-danger">Изтрий</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="buttons">
            <a class="button is-info is-small" href="{{ route('admin.index') }}">Назад</a>
{{--            <a class="button is-warning is-small">Редактирай [ADMIN]</a>--}}
{{--            <a class="button is-danger is-small">Изтрий [ADMIN]</a>--}}
        </div>
    </div>
@endsection