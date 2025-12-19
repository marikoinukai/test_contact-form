@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="contact__content">
  <div class="section__title">
    <h2>Contact</h2>
  </div>
<form class="contact-form" action="/confirm" method="post">
  @csrf
  <div class="form-row">
  <label class="form-label">お名前<span class="required">※</span></label>

  <div class="name-container">
    {{-- 姓グループ --}}
    <div class="name-group">
      <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
      @error('last_name')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left;">{{ $message }}</div>
      @enderror
    </div>

    {{-- 名グループ --}}
    <div class="name-group">
      <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
      @error('first_name')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left;">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

{{-- 性別 --}}
    <div class="form-row">
      <label class="form-label">性別<span class="required">※</span></label>
      <div class="form-field radio-field-box">
        <label class="radio">
          <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
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
      @error('gender')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left; width: 100%;">{{ $message }}</div>
      @enderror
    </div>

  {{-- メールアドレス --}}
    <div class="form-row">
      <label class="form-label">メールアドレス<span class="required">※</span></label>
      <div class="form-field">
        {{-- name="email" を追加 --}}
        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
      </div>
      @error('email')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left; width: 100%;">{{ $message }}</div>
      @enderror
    </div>

  {{-- 電話番号 --}}
    <div class="form-row">
      <label class="form-label">電話番号<span class="required">※</span></label>
      <div class="form-field tel">
        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
        <span>-</span>
        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
        <span>-</span>
        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
      </div>
      {{-- 電話番号のいずれかにエラーがあれば表示 --}}
      @if($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
        <div class="error-message" style="color: red; font-size: 12px; text-align: left; width: 100%;">
          {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
        </div>
      @endif
    </div>

    {{-- 住所 --}}
    <div class="form-row">
      <label class="form-label">住所<span class="required">※</span></label>
      <div class="form-field">
        {{-- name="address" を追加 --}}
        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
      </div>
      @error('address')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left; width: 100%;">{{ $message }}</div>
      @enderror
    </div>

    {{-- 建物名 --}}
    <div class="form-row">
      <label class="form-label">建物名</label>
      <div class="form-field">
        {{-- name="building" を追加 --}}
        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
      </div>
      @error('building')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left; width: 100%;">{{ $message }}</div>
      @enderror
    </div>

    {{-- お問い合わせの種類 --}}
    <div class="form-row">
      <label class="form-label">お問い合わせの種類<span class="required">※</span></label>
      <div class="form-field">
        <div class="select-wrapper">
          {{-- name="category_id" を追加 --}}
          <select name="category_id" class="form-select">
            <option value="" disabled selected>選択してください</option>
{{-- コントローラーから受け取った$categoriesを1つずつ取り出す --}}
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
        </option>
    @endforeach
          </select>
        </div>
      </div>
      @error('category_id')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left; width: 100%;">{{ $message }}</div>
      @enderror
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="form-row">
      <label class="form-label">お問い合わせ内容<span class="required">※</span></label>
      <div class="form-field">
        {{-- ContactRequestに合わせて name="detail" に変更 --}}
        <textarea name="detail" placeholder="お問い合わせ内容をご記載ください。">{{ old('detail') }}</textarea>
      </div>
      @error('detail')
        <div class="error-message" style="color: red; font-size: 12px; text-align: left; width: 100%;">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection
