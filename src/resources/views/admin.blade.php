@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
{{-- ページネーションの見た目を整えるためのCDN（必要に応じて） --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    /* ★ ここにhover機能のスタイルを追記します */
    .admin-table__row:hover {
        background-color: #f7f7f7;
        /* マウスが乗った時の色（薄いグレー） */
        transition: background-color 0.2s ease;
        /* 色の変化を滑らかにする */
    }

    /* ヘッダー（見出し行）はhoverしても色が変わらないように固定する */
    .admin-table__row:first-child:hover {
        background-color: transparent;
    }

    /* マウスが乗った時に少し行を強調したい場合（任意） */
    .admin-table__row:hover .admin-table__item {
        color: #333;
        /* 文字色を少し濃くする */
    }
</style>




@endsection

@section('content')
<div class="admin__content">
    <div class="admin__header">
        <h2 class="admin__title">Admin</h2>
    </div>

    {{-- 検索フォームエリア --}}
    <div class="search-section">
        <form class="search-form" action="/search" method="get">
            @csrf
            {{-- 1. キーワード検索 --}}
            <div class="search-form__item">
                <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
            </div>

            {{-- 2. 性別検索 --}}
            <div class="search-form__item">
                <select name="gender">
                    <option value="" {{ request('gender') == '' ? 'selected' : '' }}>性別</option>
                    <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>

            {{-- 3. お問い合わせの種類 --}}
            <div class="search-form__item">
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- 4. 日付検索 --}}
            <div class="search-form__item">
                <input type="date" name="date" value="{{ request('date') }}">
            </div>

            <div class="search-form__actions">
                <button class="search-form__button-submit" type="submit">検索</button>
                <a href="/reset" class="search-form__button-reset" style="text-decoration: none; display: inline-block; text-align: center;">リセット</a>
            </div>
        </form>
    </div>

    {{-- ツールバー（エクスポートとページネーション） --}}
    <div class="admin-toolbar">
        <button type="button" class="export-button" onclick="handleExport()">エクスポート</button>
        <div class="pagination-wrapper">
            {{ $contacts->links('vendor.pagination.custom') }}
        </div>
    </div>
    <script>
        function handleExport() {
            // 検索フォームを取得
            const form = document.querySelector('.search-form');
            // 元のアクションURL（/search）を保存
            const originalAction = form.action;

            // 送信先をCSVダウンロード用URLに変更
            form.action = '/export';
            // フォームを送信
            form.submit();

            // ★重要：0.1秒待ってからURLを元に戻す（送信完了を確実にするため）
            setTimeout(() => {
                form.action = originalAction;
            }, 100);
        }
    </script>

    {{-- お問い合わせ一覧テーブル --}}
    <div class="admin-table__wrapper">
        <table class="admin-table">
            <tr class="admin-table__row">
                <th class="admin-table__header">お名前</th>
                <th class="admin-table__header">性別</th>
                <th class="admin-table__header">メールアドレス</th>
                <th class="admin-table__header">お問い合わせの種類</th>
                <th class="admin-table__header"></th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="admin-table__row">
                <td class="admin-table__item">
                    {{ $contact->last_name }}　{{ $contact->first_name }}
                </td>
                <td class="admin-table__item">
                    @if($contact->gender == 1) 男性
                    @elseif($contact->gender == 2) 女性
                    @else その他 @endif
                </td>
                <td class="admin-table__item">
                    {{ $contact->email }}
                </td>
                <td class="admin-table__item">
                    {{ $contact->category->content }}
                </td>
                <td class="admin-table__item">
                    {{-- 詳細ボタン --}}
                    <button type="button" class="detail-button js-modal-open" data-target="modal-{{ $contact->id }}">詳細</button>

                    {{-- ★ここが重要：モーダル本体を td の中、かつ a タグの後ろに移動させます --}}
                    <div class="modal" id="modal-{{ $contact->id }}">
                        <div class="modal-overlay js-modal-close"></div>
                        <div class="modal__content">
                            {{-- 閉じる「×」ボタン --}}
                            <button type="button" class="modal__close js-modal-close">×</button>
                            <div class="modal__inner">
                                <table class="modal-table">
                                    <tr>
                                        <th>お名前</th>
                                        <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>性別</th>
                                        <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                                    </tr>
                                    <tr>
                                        <th>メールアドレス</th>
                                        <td>{{ $contact->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>電話番号</th>
                                        <td>{{str_replace('-', '', $contact->tel)}}</td>
                                    </tr>
                                    <tr>
                                        <th>住所</th>
                                        <td>{{ $contact->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>建物名</th>
                                        <td>{{ $contact->building }}</td>
                                    </tr>
                                    <tr>
                                        <th>お問い合わせの種類</th>
                                        <td>{{ $contact->category->content }}</td>
                                    </tr>
                                    <tr>
                                        <th>お問い合わせ内容</th>
                                        <td>{{ $contact->detail }}</td>
                                    </tr>
                                </table>
                                <form action="/delete" method="post" class="delete-form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $contact->id }}">
                                    <button type="submit" class="delete-button">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 開くボタンの動作
        const openBtns = document.querySelectorAll('.js-modal-open');
        openBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const modal = document.getElementById(targetId);
                if (modal) {
                    modal.classList.add('is-open');
                }
            });
        });

        // 閉じるボタン（×ボタンと背景）の動作
        const closeBtns = document.querySelectorAll('.js-modal-close');
        closeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = this.closest('.modal');
                if (modal) {
                    modal.classList.remove('is-open');
                }
            });
        });
    });
</script>
@endsection