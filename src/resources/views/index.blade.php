@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="contact__content">
  <div class="section__title">
    <h2>Contact</h2>
  </div>

  <form class="form contact-form" action="/confirm" method="post">
    @csrf

    {{-- お名前 --}}
    <div class="form-row">
      <div class="form-label">お名前<span class="required">※</span></div>
      <div class="name-container">
        <div class="name-group">
          <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
        </div>
        <div class="name-group">
          <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
        </div>
      </div>
    </div>

    {{-- 性別 --}}
    <div class="form-row">
      <div class="form-label">性別<span class="required">※</span></div>
      <div class="radio-field-box">
        <label class="radio">
          <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
          <span class="radio-mark"></span><span class="radio-text">男性</span>
        </label>
        <label class="radio">
          <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
          <span class="radio-mark"></span><span class="radio-text">女性</span>
        </label>
        <label class="radio">
          <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
          <span class="radio-mark"></span><span class="radio-text">その他</span>
        </label>
      </div>
    </div>

    {{-- メールアドレス --}}
    <div class="form-row">
      <div class="form-label">メールアドレス<span class="required">※</span></div>
      <div class="form-field">
        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
      </div>
    </div>

    {{-- 電話番号 --}}
    <div class="form-row">
      <div class="form-label">電話番号<span class="required">※</span></div>
      <div class="form-field tel">
        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
        <span>-</span>
        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
        <span>-</span>
        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
      </div>
    </div>

    {{-- 住所 --}}
    <div class="form-row">
      <div class="form-label">住所<span class="required">※</span></div>
      <div class="form-field">
        <input type="text" name="address" placeholder="例: 東京都渋谷区..." value="{{ old('address') }}">
      </div>
    </div>

    {{-- 建物名 --}}
    <div class="form-row">
      <div class="form-label">建物名</div>
      <div class="form-field">
        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
      </div>
    </div>

    {{-- お問い合わせの種類 --}}
    <div class="form-row">
      <div class="form-label">お問い合わせの種類<span class="required">※</span></div>
      <div class="select-wrapper">
        <select class="form-select" name="category_id">
          <option value="">選択してください</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="form-row">
      <div class="form-label">お問い合わせ内容<span class="required">※</span></div>
      <div class="form-field">
        <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
      </div>
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection