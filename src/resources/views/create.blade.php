@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact__alert">
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
</div>
<div class="contact__content">
  <div class="section__title">
    <h2>Contact</h2>
</div>
<form class="create-form" action="/contacts" method="post">
  @csrf
    <div class="create-form__item">
      <label for="contact_name" class="create-form__label">お名前</label>
      <input 
        class="create-form__item-input" 
        type="text" 
        name="contact_name"
        value="{{ old('contact_name') }}"
        placeholder="例: 牛乳">
      <label for="price" class="create-form__label">性別</label>
      <input 
        class="create-form__item-input2" 
        type="number" 
        name="price"
        value="{{ old('price') }}"
        placeholder="例: 350">
          <select class="create-form__item-select" name="admin_id">
            <option value="">カテゴリ</option>
            @foreach ($admins as $admin)
              <option value="{{ $admin['id'] }}">{{ $admin['name'] }}</option>
            @endforeach
          </select>
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">
        登録
      </button>
    </div>
</form>
<div class="section__title">
  <h2>商品検索</h2>
</div>
<form class="search-form" action="/contacts/search" method="get">
  @csrf
    <div class="search-form__item">
      <label for="contact_name" class="create-form__label">商品</label>
      <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}"
      placeholder="例: 牛乳">
      <label for="price" class="create-form__label">価格</label>
      <input class="search-form__item-input2" type="number" name="price" value="{{ old('price') }}"
      placeholder="例: 350">
        <select class="search-form__item-select" name="admin_id">
          <option value="">カテゴリ</option>
            @foreach ($admins as $admin)
              <option value="{{ $admin['id'] }}">{{ $admin['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">
        検索
      </button>
    </div>
</form>
<div class="contact-table">
  <table class="contact-table__inner">
    <tr class="contact-table__row">
      <th class="contact-table__header">
        <span class="contact-table__header-span">商品</span>
        <span class="contact-table__header-span2">価格(円)</span> 
        <span class="contact-table__header-span3">カテゴリ</span> 
      </th>
    </tr>
    <!-- @foreach ($contacts as $contact)
      <tr class="contact-table__row">
        <td class="contact-table__item">
          <form class="update-form" action="/contacts/update" method="POST">
            @method('PATCH')
            @csrf
            <div class="update-form__item">
              <input 
                class="update-form__item-input" 
                type="text" 
                name="contact_name" 
                value="{{ $contact['contact_name'] }}"
              />
              <input type="hidden" name="id" value="{{ $contact['id'] }}"/>
            </div>
            <div class="update-form__item">
              <input 
                class="update-form__item-input2" 
                type="number" 
                name="price" 
                value="{{ $contact['price'] }}"
              />
            </div>
            <div class="update-form__item">
              <p class="update-form__itme-p">{{ $contact['admin']['name'] }}</p>
            </div>
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">
                更新
              </button>
            </div>
          </form>
        </td>
        <td class="contact-table__item">
          <form class="delete-form" action="/contacts/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
              <input type="hidden" name="id" value="{{ $contact['id'] }}">
                <button class="delete-form__button-submit" type="submit">
                  削除
                </button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach -->
    </table>
  </div>
</div>
@endsection