@extends('layouts.master')

@section('title', 'Логин')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">

            <h3>Авторизация</h3>

            <form method="POST" action="">
                <!-- Phone input -->
                <div class="form-outline mb-4">
                    <input type="text" name="phone" id="phone" class="form-control" />
                    <label class="form-label" for="phone">Телефон</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input id="password" type="password" class="form-control" name="password" required />
                    <label class="form-label" for="password">Пароль</label>
                </div>

            @csrf

            <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Заказать</button>
            </form>
        </div>
    </div>
@endsection