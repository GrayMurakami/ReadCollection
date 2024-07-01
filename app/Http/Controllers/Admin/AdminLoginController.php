<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    private $adminID = 'DiGray'; // ハードコードされた管理者ID
    private $adminPassword = 'fibhjub0008'; // ハードコードされた管理者パスワード
    private $adminName = 'Gray';

    public function showLoginForm()
    {
        return view('admin.login'); // 管理者ログインフォームの表示
    }

    public function login(Request $request)
    {
        $request->validate([
            'adminID' => 'required',
            'adminPassword' => 'required',
        ]);

        $adminID = $request->input('adminID');
        $adminPassword = $request->input('adminPassword');

        if ($adminID === $this->adminID && $adminPassword === $this->adminPassword) {
            // ログインに成功し、ダッシュボードにリダイレクトされました
            return redirect()->route('adminDashboard')->with('success', 'エントリー成功 !');
        } else {
            // ログインエラー
            return back()->withErrors(['adminID' => '無効なIDまたはパスワード']);
        }
    }

    public function showDashboard()
    {
        $adminName = $this->adminName; // 管理者のフルネームを取得
        return view('admin.adminDashboard', ['adminName' => $adminName]); // // 管理者ダッシュボードのプレゼンテーション
    }

    public function logout()
    {
        // セッションから管理者情報を削除
        Session::forget('admin');
        return redirect()->route('adminLogin')->with('success', 'ログアウト成功 !');
    }
}
