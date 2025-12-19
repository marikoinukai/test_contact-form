<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
// 登録画面を表示
    public function index()
    {
        return view('auth.register'); // 作成したBladeを指定
    }

    // 登録処理を実行
    public function store(RegisterRequest $request)
    {
        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 作成したユーザーでそのままログインさせる
        auth()->login($user);

        // ログイン後の管理画面（adminなど）へリダイレクト
        return redirect('/admin');
    }
}
