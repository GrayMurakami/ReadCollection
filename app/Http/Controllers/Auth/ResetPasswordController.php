<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Events\AuditLogEvent;


class ResetPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        // 入力データの検証
        $validator = Validator::make($request->all(), [
            'resetPasswordEmail' => 'required|email',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['message' => '入力データが無効です。'], 400);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 入力されたメールアドレスでユーザーを検索
        $email = $request->input('resetPasswordEmail');
        $user = User::where('email', $email)->first();

        if (!$user) {
            if ($request->ajax()) {
                return response()->json(['message' => '入力されたメールアドレスは登録されていません。'], 400);
            }
            return redirect()->back()->with('error', '入力されたメールアドレスは登録されていません。');
        }

        // ランダムなパスワードの生成
        $tempPassword = Str::random(10); // ランダムな10文字のパスワードを生成

        // ユーザーのパスワードを更新
        $user->password = bcrypt($tempPassword);
        $user->save();

        // 監査エントリのパスワード更新を要求するイベントを作成
        event(new AuditLogEvent($user->id, 'password_reset', 'Password reset for user ' . $user->name . '. With email: ' . $user->email));

        // パスワードリセットのメールを送信
        try {
            Mail::send('emails.reset_password', ['password' => $tempPassword], function ($message) use ($email) {
                $message->to($email)->subject('パスワードのリセット');
            });
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['message' => 'パスワードリセットのメールの送信中にエラーが発生しました。'], 500);
            }
            return redirect()->back()->with('error', 'パスワードリセットのメールの送信中にエラーが発生しました。');
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'パスワードリセットのメッセージが正常に送信されました。'], 200);
        }

        return redirect()->route('topPage')->with('success', 'パスワードリセットのメッセージが正常に送信されました。');
    }
}
