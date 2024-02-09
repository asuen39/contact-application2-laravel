<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout(); // ログアウト処理

        $request->session()->invalidate(); // セッションを無効にする
        $request->session()->regenerateToken(); // 新しいトークンを生成する

        return redirect('/login'); // ログアウト後のリダイレクト先を指定
    }
}
