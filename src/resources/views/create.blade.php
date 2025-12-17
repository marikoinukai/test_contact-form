@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<!-- <div class="contact__alert">
  @if(session('message'))
    <div class="contact__alert--success">
      {{ session('message') }}
    </div>
  @endif
  @if ($errors->any())
    <div class="contact__alert--danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div> -->
<div class="contact__content">
  <div class="section__title">
    <h2>Contact</h2>
  </div>
<form class="contact-form" action="/contacts" method="post">
  @csrf
  <div class="form-row">
    <label class="form-label">お名前<span class="required">※</span></label>
      <div class="form-field">
        <input type="text" placeholder="例: 山田">
        <input type="text" placeholder="例: 太郎">
      </div>
  </div>

  <div class="form-row">
    <label class="form-label">性別<span class="required">※</span></label>
      <div class="form-field">
        <div class="form-field radio-field-box">
        <div class="form-field-radio label">
        <label class="radio"><input type="radio" name="gender" value="male" checked> <span class="radio-mark"></span>男性</label>
        <label class="radio"><input type="radio" name="gender" value="female"><span class="radio-mark"></span> 女性</label>
        <label class="radio"><input type="radio" name="gender" value="other"> <span class="radio-mark"></span>その他</label>



</div>
      </div>
      </div>
    </div>

  <div class="form-row">
    <label class="form-label">メールアドレス<span class="required">※</span></label>
      <div class="form-field">
        <input type="email" placeholder="例:test@example.com">
      </div>
  </div>

  <div class="form-row">
    <label class="form-label">電話番号<span class="required">※</span></label>
      <div class="form-field tel">
        <input type="text" name="tel1" placeholder="080">
        <span>-</span>
        <input type="text" name="tel2" placeholder="1234">
        <span>-</span>
        <input type="text" name="tel3" placeholder="5678">
      </div>
  </div>

  <div class="form-row">
    <label class="form-label">住所<span class="required">※</span></label>
      <div class="form-field">
        <input type="text" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3">
      </div>
  </div>

  <div class="form-row">
    <label class="form-label">建物名</label>
      <div class="form-field">
        <input type="text" placeholder="例:千駄ヶ谷マンション101">
      </div>
  </div>

  <div class="form-row">
    <label class="form-label">お問い合わせの種類<span class="required">※</span></label>
      <div class="form-field">

        <div class="select-wrapper">

        <select class="form-select">

          

          <!-- <select name="category"> -->
          <option value="" disabled selected>選択してください</option>
          <option value="1">お問い合わせ</option>
          <option value="2">ご質問</option>
        </select>
        </div>
    </div>
  </div>

  <div class="form-row">
    <label class="form-label">お問い合わせ内容<span class="required">※</span></label>
      <div class="form-field">
        <textarea name="content" placeholder="お問い合わせ内容をご記載ください。"></textarea>
      </div>
  </div>
</form>

<form class="search-form" action="/contacts/search" method="get">
  @csrf
    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
</form>

    </table>
  </div>
</div>
@endsection