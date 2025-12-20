@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth__content">
    <div class="auth__header">
        <h2 class="auth__title">Login</h2>
    </div>
    <div class="auth__card">
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="form__label">メールアドレス</div>
                <div class="form__input">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">パスワード</div>
                <div class="form__input">
                    <input type="password" name="password" placeholder="例: coachtech06">
                </div>
                <div class="form__error">
                    @error('password') {{ $message }} @enderror
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection