@extends('layouts.app')

@section('page-title')
ユーザー一覧ページ
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('navigation')
<form action="/" method="get">
    @csrf
    <div class="button">
        <button class="navigation__button" type="submit">ホーム</button>
    </div>
</form>
<form action="/attendance" method="get">
    @csrf
    <div class="button">
        <button class="navigation__button" type="submit">日付一覧</button>
        <input type="hidden" name="date" value="">
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
<div class="table__form">
    <table class="user-table">
        <tr>
            <th class="name">名前</th>
            <th class="email">メールアドレス</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <form class="user__information" action="/users/attendance" method="get">
                @csrf
                <td class="name">{{ $user->name }}</td>
                <td class="email">{{ $user->email }}</td>
                <td>
                    <button class="detail">勤怠表</button>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                </td>
            </form>
        </tr>
        @endforeach
    </table>
    {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection