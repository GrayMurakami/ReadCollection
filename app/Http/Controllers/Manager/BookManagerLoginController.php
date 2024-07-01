<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BookManagerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('bookManager.login'); // 書籍管理者ログインフォームの表示
    }

    public function login(Request $request)
    {
        $request->validate([
            'bookAdminID' => 'required',
            'bookAdminPassword' => 'required',
        ]);

        $bookAdminID = $request->input('bookAdminID');
        $bookAdminPassword = $request->input('bookAdminPassword');

        $bookManager = BookManager::where('bookAdminID', $bookAdminID)->first();

        if ($bookManager && Hash::check($bookAdminPassword, $bookManager->password)) {

            // セッションにユーザー情報を保存
            Session::put('bookManager', $bookManager);

            // // ログインに成功し、ダッシュボードにリダイレクトされました
            return redirect()->route('bookManagerDashboard')->with('success', 'エントリー成功 !');
        } else {
            // ログインエラー
            return back()->withErrors(['bookAdminID' => '無効なIDまたはパスワード']);
        }
    }

    public function showDashboard()
    {
        return view('bookManager.bookManagerDashboard'); // 書籍管理者ダッシュボードのプレゼンテーション
    }

    public function logout()
    {
        // セッションから書籍管理者情報を削除
        Session::forget('bookManager');
        return redirect()->route('bookManagerLogin')->with('success', 'ログアウト成功 !');
    }
}
