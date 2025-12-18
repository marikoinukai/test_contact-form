<?php

namespace App\Http\Controllers;

// 1. ContactRequestをインポートする
use App\Http\Requests\ContactRequest; 
use App\Models\Contact; // 保存に使う場合はModelも必要

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // 入力画面の表示
    public function index()
    {
        return view('create');
    }

    // 確認画面の表示
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name', 
            'first_name', 
            'gender', 
            'email', 
            'tel1', 
            'tel2', 
            'tel3', 
            'address', 
            'building', 
            'category_id', // お問い合わせの種類
            'content'      // お問い合わせ内容
        ]);

        return view('confirm', compact('contact'));
    }

    // DBへの保存処理
    public function store(ContactRequest $request)
    {
        // 修正ボタンが押された場合の処理
        if($request->input('back')){
            return redirect('/')->withInput();
        }

        // 保存用データの作成
        $contact = $request->only([
            'first_name', 
            'last_name', 
            'gender', 
            'email', 
            'address', 
            'building', 
            'category_id', 
            'content'
        ]);

        // 電話番号を結合
        $contact['tel'] = $request->tel1 . '-' . $request->tel2 .'-' .  $request->tel3;

        Contact::create($contact);

        return view('thanks');
    }
}