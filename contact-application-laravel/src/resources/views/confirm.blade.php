@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="section__title">
        <h2>Confirm</h2>
    </div>
    <div class="confirm__inner">
        <form class="confirm__form" action="{{ route('store') }}" method="post">
            @csrf
            <div class="confirm__table">
                <table class="confirm__table-inner">
                    <tr class="confirm__table-row">
                        <th class="confirm__table-header">お名前</th>
                        <td class="confirm__table-text">
                            {{ $contact['first_name'] }} {{ $contact['last_name'] }}
                            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        </td>
                    </tr>
                    <tr class="confirm__table-row">
                        <th class="confirm__table-header">性別</th>
                        <td class="confirm__table-text">
                            {{ $contact['gender'] }}
                            <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                        </td>
                    </tr>
                    <tr class="confirm__table-row">
                        <th class="confirm__table-header">メールアドレス</th>
                        <td class="confirm__table-text">
                            {{ $contact['email'] }}
                            <input type="hidden" name="email" value="{{ $contact['email'] }}">
                        </td>
                    </tr>
                    <tr class="confirm__table-row">
                        <th class="confirm__table-header">電話番号</th>
                        <td class="confirm__table-text">
                            {{ $contact['tell1'] }}{{ $contact['tell2'] }}{{ $contact['tell3'] }}
                            <input type="hidden" name="tell" value="{{ $contact['tell1'] }}{{ $contact['tell2'] }}{{ $contact['tell3'] }}">
                        </td>
                    </tr>
                    <tr class="confirm__table-row">
                        <th class="confirm__table-header">住所</th>
                        <td class="confirm__table-text">
                            {{ $contact['address'] }}
                            <input type="hidden" name="address" value="{{ $contact['address'] }}">
                        </td>
                    </tr>
                    <tr class="confirm__table-row">
                        <th class="confirm__table-header">お問い合わせの種類</th>
                        <td class="confirm__table-text">
                            {{ $categories->where('id', $contact['category_id'])->first()->content }}
                            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                        </td>
                    </tr>
                    <tr class="confirm__table-row">
                        <th class="confirm__table-header">お問い合わせ内容</th>
                        <td class="confirm__table-text">
                            {{ $contact['detail'] }}
                            <input type="hidden" name="content" value="{{ $contact['detail'] }}">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
            </div>
        </form>
        <form class="confirm__form" action="{{ route('inquiry') }}" method="get">
            @csrf
            <div class="form__button-right">
                <button class="form__button-submit-right" type="submit">修正</button>
            </div>
        </form>
    </div>
</div>
@endsection