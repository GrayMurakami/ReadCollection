<?php

namespace App\Http\Controllers\Auth;

use App\Models\User; // ユーザーモデルのインポート
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Events\AuditLogEvent;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // 登録フォームを表示する
    }

    public function register(Request $request)
    {

        Log::info('登録が始まった');

        // データ・バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレスを入力してください',
            'email.unique' => 'このメールアドレスは既に登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは最低8文字以上で入力してください',
        ]);

        Log::info('バリデーションは通過した');

        // 新規ユーザーの作成
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        Log::info('ユーザーが作成した', ['user_id' => $user->id]);

        // 自動ユーザー認証
        Auth::login($user);

        Log::info('ユーザーは認証されている');

        // 登録に成功したら、イベントを呼び出す
        event(new AuditLogEvent($user->id, 'register', 'User ' . $user->name . ' registered. With email: ' . $user->email));

        // ホームページへのリダイレクト
        return redirect('/home');
    }
}
