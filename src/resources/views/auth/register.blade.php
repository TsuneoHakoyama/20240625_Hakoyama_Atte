@extends('layouts.app')

@section('page-title')
ユーザー登録
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__form">
    <div class="input__form">
        <p class="register__title">会員登録</p>
        <form action="/register" method="post">
            @csrf
            <div class="input__item">
                <input type="text" class="input__name" name="name" placeholder="名前" value="{{ old('name') }}">
            </div>
            <div class="error-message">
                @if ($errors->has('name'))
                {{ $errors->first('name')}}
                @endif
            </div>
            <div class="input__item">
                <input type="text" class="input__email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            </div>
            <div class="error-message">
                @if ($errors->has('email'))
                {{ $errors->first('email')}}
                @endif
            </div>
            <div class="input__item">
                <input type="password" class="input__password" name="password" placeholder="パスワード" value="{{ old('password') }}">
            </div>
            <div class="error-message">
                @if ($errors->has('password'))
                {{ $errors->first('password')}}
                @endif
            </div>
            <div class="input__item">
                <input type="password" class="input__password-confirm" name="password_confirmation" placeholder="確認用パスワード" value="{{ old('password-confirmation') }}">
            </div>
            <div class="input__button">
                <button class="submit__button" type="submit">会員登録</button>
            </div>
        </form>
        <div class="link__login">
            <p class="link__description">アカウントをお持ちの方はこちらから</p>
            <a href="{{ url('/login') }}">ログイン</a>
        </div>
    </div>
</div>
@endsection