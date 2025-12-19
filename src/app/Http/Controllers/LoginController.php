<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

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
        // メールとパスワードで認証を試みる
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // 成功したらセッションを再生成して管理画面へ
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // 失敗したらエラーメッセージを付けて戻す
        return back()->withErrors([
            'email' => 'ログイン情報が登録されていません',
        ])->onlyInput('email');
    }

    // ログアウト処理（ついでに作っておくと便利です）
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
