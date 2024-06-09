@extends('layouts.app')

@section('page-title')
日付一覧
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
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
<div class="search__form">
    <div class="search__date">
        <div class="search__button">
            <form action="/attendance/previous" method="get">
                @csrf
                <button class="previous-day" type="submit">
                    < </button>
                        <input type="hidden" name="date" value="{{ $date }}">
            </form>
        </div>
        <div class="date">
            <p class="today">{{ $date }}</p>
        </div>
        <div class="search__button">
            <form action="/attendance/next" method="get">
                @csrf
                <button class="next-day" type="submit"> > </button>
                <input type="hidden" name="date" value="{{ $date }}">
            </form>
        </div>
    </div>
</div>
<div class="table__form">
    <table class="working-hour">
        <tr>
            <th class="name">名前</th>
            <th class="work__start">勤務開始</th>
            <th class="work__end">勤務終了</th>
            <th class="break__total">休憩時間</th>
            <th class="working__hours">勤務時間</th>
        </tr>
        @foreach ($attendances as $attendance)
        <tr>
            <td class="name">{{ $attendance->user->name }}</td>
            <td class="work__start">{{ $attendance->work_start->format('H:i:s') }}</td>
            @if (is_null($attendance->work_end))
            <td class="work__end"></td>
            <td class="break__total"></td>
            <td class="working__hours"></td>
            @else
            <td class="work__end">{{ $attendance->work_end->format('H:i:s') }}</td>
            @if ($attendance->breakTimes->isEmpty())
            <td class="break__total">00:00:00</td>
            @else
            <td class="break___total">{{ $formattedTimes[$loop->index] }}</td>
            @endif
            <td class="working__hours">{{ $attendance['working_hours'] }}</td>
            @endif
        </tr>
        @endforeach
    </table>
    {{ $attendances->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection