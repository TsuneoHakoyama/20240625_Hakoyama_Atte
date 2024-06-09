@extends('layouts.app')

@section('page-title')
ログイン
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__form">
    <div class="input__form">
        <p class="login__title">ログイン</p>
        <form action="/login" method="post">
            @csrf
            <div class="input__item">
                <input class="input__text" type="text" class="input__email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            </div>
            <div class="error-message">
                @if ($errors->has('email'))
                {{ $errors->first('email')}}
                @endif
            </div>
            <div class=" input__item">
                <input class="input__text" type="password" class="input__password" name="password" placeholder="パスワード" value="{{ old('password') }}">
            </div>
            <div class="error-message">
                @if ($errors->has('email'))
                {{ $errors->first('email')}}
                @endif
            </div>
            <div class=" input__button">
                <button class="submit__button" type="submit">ログイン</button>
            </div>
        </form>
        <div class="link__register">
            <p class="link__description">アカウントをお持ちでない方はこちらから</p>
            <a href="{{ url('/register') }}">会員登録</a>
        </div>
    </div>
</div>
@endsection