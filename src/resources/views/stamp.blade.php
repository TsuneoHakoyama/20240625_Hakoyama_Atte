@extends('layouts.app')

@section('page-title')
打刻ページ
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('navigation')
<form action="/attendance" method="get">
    @csrf
    <div class="button">
        <button class="navigation__button" type="submit">日付一覧</button>
        <input type="hidden" name="date" value="">
    </div>
</form>
<form action="/users" method="get">
    @csrf
    <div class="button">
        <button class="navigation__button" type="submit">ユーザー一覧</button>
    </div>
</form>
<form action="/logout" method="post">
    @csrf
    <div class="button">
        <button class="navigation__button" type="submit">ログアウト</button>
    </div>
</form>
@endsection

@section('content')
<div class="stamp__form">
    <div class="input__form">
        <div class="main__title">
            <p>{{ Auth::user()->name }}さんお疲れ様です！</p>
            <div class="stamp__alert">
                @if (session('message'))
                <div class="stamp__alert--success">
                    {{ session('message') }}
                </div>
                @endif
            </div>
            <div class="button__field">
                <!-- 勤務中の場合 -->
                @if($work_status === 'on_duty')
                <div class="work__start">
                    <form action="/work-start" method="post">
                        @csrf
                        <button class="submit__button" disabled>勤務開始</button>
                    </form>
                </div>
                <!-- 勤務中かつ休憩中の場合 -->
                @if($break_status === 'on_my_break')
                <div class="work__end">
                    <form action="/work-end" method="post">
                        @csrf
                        <button class="submit__button" disabled>勤務終了</button>
                    </form>
                </div>
                <div class="break_start">
                    <form action="/break-start" method="post">
                        @csrf
                        <button class="submit__button" disabled>休憩開始</button>
                    </form>
                </div>
                <div class="break_end">
                    <form action="/break-end" method="post">
                        @csrf
                        <button class="submit__button" type="submit">休憩終了</button>
                        <input type="hidden" name="id" value="{{ $record->id}}">
                    </form>
                </div>
                @else
                <!-- 勤務中で休憩中ではない場合 -->
                <div class="work__end">
                    <form action="/work-end" method="post">
                        @csrf
                        <button class="submit__button">勤務終了</button>
                    </form>
                </div>
                <div class="break_start">
                    <form action="/break-start" method="post">
                        @csrf
                        <button class="submit__button">休憩開始</button>
                        <input type="hidden" name="id" value="{{ $record->id}}">
                    </form>
                </div>
                <div class="break_end">
                    <form action="/break-end" method="post">
                        @csrf
                        <button class="submit__button" type="submit" disabled>休憩終了</button>
                    </form>
                </div>
                @endif
                @else
                <div class="work__start">
                    <form action="/work-start" method="post">
                        @csrf
                        <button class="submit__button">勤務開始</button>
                    </form>
                </div>
                <div class="work__end">
                    <form action="/work-end" method="post">
                        @csrf
                        <button class="submit__button" disabled>勤務終了</button>
                    </form>
                </div>
                <div class="break_start">
                    <form action="/break-start" method="post">
                        @csrf
                        <button class="submit__button" disabled>休憩開始</button>
                    </form>
                </div>
                <div class="break_end">
                    <form action="/break-end" method="post">
                        @csrf
                        <button class="submit__button" type="submit" disabled>休憩終了</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection