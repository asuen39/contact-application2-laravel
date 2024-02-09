@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inquiry.css') }}">
@endsection

@section('content')
<div class="inquiry__content">
    <div class="section__title">
        <h2>Contact</h2>
    </div>
    <!-- バリデーションエラーメッセージの表示 -->
    @if ($errors->any())
    <div class="alert alert-danger form__error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="inquiry__form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text name_group">
                    <input type="text" name="first_name" placeholder="例：山田" value="{{ old('first_name', $previousInput['first_name'] ?? '') }}" />
                    <input type="text" name="last_name" placeholder="例：太郎" value="{{ old('last_name', $previousInput['last_name'] ?? '') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__radio--text">
                    <input type="radio" id="male" name="gender" value="男性" {{ (old('gender') === '男性' || (old('gender') === null && (empty($previousInput['gender']) || $previousInput['gender'] === '男性'))) ? 'checked' : '' }}>
                    <label for="male" class="radio_round">男性</label>
                    <input type="radio" id="female" name="gender" value="女性" {{ (old('gender') === '女性' || (empty(old('gender')) && !empty($previousInput['gender']) && $previousInput['gender'] === '女性')) ? 'checked' : '' }}>
                    <label for="female" class="radio_round">女性</label>
                    <input type="radio" id="other" name="gender" value="その他" {{ (old('gender') === 'その他' || (empty(old('gender')) && !empty($previousInput['gender']) && $previousInput['gender'] === 'その他')) ? 'checked' : '' }}>
                    <label for="other" class="radio_round">その他</label>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="test@example.com" value="{{ old('email', $previousInput['email'] ?? '') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="tell" name="tell1" class="form__tell" pattern="[0-9]{3}" placeholder="080" value="{{ old('tell1', $previousInput['tell1'] ?? '') }}" maxlength="3" />
                    - <input type="tell" name="tell2" class="form__tell" pattern="[0-9]{4}" placeholder="9999" value="{{ old('tell2', $previousInput['tell2'] ?? '') }}" maxlength="4" />
                    - <input type="tell" name="tell3" class="form__tell" pattern="[0-9]{4}" placeholder="9999" value="{{ old('tell3', $previousInput['tell3'] ?? '') }}" maxlength="4" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例：東京都" value="{{ old('address', $previousInput['address'] ?? '') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例:マンション" value="{{ old('building', $previousInput['building'] ?? '') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <select name="category_id" id="" class="category__group">
                        <option value="" selected disabled>選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $previousInput['category_id'] ?? '') == $category->id) ? 'selected' : '' }}>{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $previousInput['detail'] ?? '') }}</textarea>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection