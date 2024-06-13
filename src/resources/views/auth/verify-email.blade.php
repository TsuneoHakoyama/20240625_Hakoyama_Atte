@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('確認用リンクを送信しました') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('ご登録いただいたメールアドレスに確認用のリンクをお送りしました。') }}
                    </div>
                    @endif

                    {{ __('ご登録いただいたアドレスに確認用のリンクをお送りしました。') }}
                    {{ __('もし確認用メールが送信されていない場合は、"再送信する"をクリックしてください。') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('確認メールを再送信する') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection