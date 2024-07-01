<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Events\AuditLogEvent;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // ログインフォームを表示する
    }

    public function login(Request $request)
    {
        // データ・バリデーション
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレスを入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは最低8文字で入力してください',
        ]);

        // ユーザー認証の試み
        if (Auth::attempt($credentials)) {
            // 認証成功
            $request->session()->regenerate();

            // ログイン成功のイベントを記録
            event(new AuditLogEvent(Auth::id(), 'login', 'User ' . Auth::user()->name . ' logged in. With email: ' . Auth::user()->email));

            return redirect()->intended('/home'); // ホームページへのリダイレクト
        } else {
            // 誤った認証情報
            return back()->withErrors(['email' => '電子メールまたはパスワードが正しくありません。.']);
        }
    }

    public function logout(Request $request)
    {
        // logout 前のユーザー取得
        $user = Auth::user();

        Auth::logout();

        // 監査に記録されるユーザーログアウトイベントを作成
        if ($user) {
            event(new AuditLogEvent($user->id, 'logout', 'User ' . $user->name . ' logged out. With email: ' . $user->email));
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
