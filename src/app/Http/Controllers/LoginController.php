<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // ログイン画面表示
    public function index()
    {
        return view('auth.login'); 
    }

    // ログイン処理
    public function store(LoginRequest $request)
    {
        // 認証に必要な情報のみを取り出す
        $credentials = $request->only(['email', 'password']);

        // メールとパスワードで認証を試みる
        if (Auth::attempt($credentials)) {
            // 成功したらセッションを再生成して管理画面へ
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // 失敗したらエラーメッセージを付けて戻す
        return back()->withErrors([
            'login_error' => 'メールアドレスまたはパスワードが正しくありません',
        ])->withInput(); // password以外を入力状態のまま戻す
    }

    // ログアウト処理
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
