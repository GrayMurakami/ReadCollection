<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Events\AuditLogEvent;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            $body = "名前: {$data['firstName']}\n電話番号: {$data['phone']}\nメールアドレス: {$data['email']}\nお問い合わせ内容:\n{$data['message']}";

            Mail::raw($body, function ($message) use ($data) {
                $message->to('di-gray@rambler.ru')
                    ->subject('New Contact Message');
            });

            // 監査記録の管理者にメッセージを送信するイベントを作成
            event(new AuditLogEvent(auth()->id(), 'send_message', 'User ' . auth()->user()->name . ' sent a contact message'));

            return back()->with('success', 'メッセージが送信されました。');
        } catch (\Exception $e) {
            return back()->withErrors('メッセージの送信に失敗しました。もう一度お試しください。');
        }
    }
}
