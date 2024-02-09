<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="section__title">
        <h2>Register</h2>
    </div>
    <form class="register__form" action="{{ route('register') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input id="name" type="text" name="name" placeholder="例: 山田太郎" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
                @error('name')
                <div class="form__error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input id="email" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" required autocomplete="email">
                </div>
                @error('email')
                <div class="form__error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input id="password" type="password" name="password" placeholder="例: coachteno6" required autocomplete="new-password">
                </div>
                @error('password')
                <div class="form__error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection