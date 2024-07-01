<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\BookManager;
use App\Models\AuditLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    private $adminName = 'Gray';

    public function manageUsers()
    {
        $users = User::all();
        $adminName = $this->adminName;
        return view('admin.manageUsers', compact('users'), ['adminName' => $adminName]);
    }

    public function processUserAction(Request $request)
    {
        $request->validate([
            'action' => 'required', // 行動 (追加・編集)
            'user_id' => 'required_if:action,edit', // ユーザーID（編集専用）
            'name' => 'required', // ユーザー名（追加・編集用）
            'email' => 'required|email|unique:users,email,' . ($request->action == 'edit' ? $request->user_id : 'NULL'), // ユーザーEメール（追加・編集用）
            'password' => 'nullable|min:8|confirmed', // ユーザーパスワード（編集時は任意）
        ]);

        if ($request->action == 'add') {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return redirect()->route('admin.manageUsers')->with('success', 'ユーザーの追加に成功しました。');
        } elseif ($request->action == 'edit') {
            $user = User::findOrFail($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            return redirect()->route('admin.manageUsers')->with('success', 'ユーザーの編集に成功しました。');
        } else {
            return back()->withErrors(['action' => '誤った行為。']);
        }
    }


    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true]);
    }


    // 書籍管理者管理ページを表示するメソッド
    public function manageBookManagers()
    {
        $bookManagers = BookManager::all();
        $adminName = $this->adminName;
        return view('admin.manageBookManagers', compact('bookManagers'), ['adminName' => $adminName]);
    }

    public function processBookManagerAction(Request $request)
    {
        $request->validate([
            'action' => 'required',
            'manager_id' => 'required_if:action,edit',
            'name' => 'required',
            'bookAdminID' => 'required|unique:book_managers,bookAdminID,' . ($request->action == 'edit' ? $request->manager_id : 'NULL'),
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->action == 'add') {
            BookManager::create([
                'name' => $request->name,
                'bookAdminID' => $request->bookAdminID,
                'password' => bcrypt($request->password),
            ]);
            return redirect()->route('admin.manageBookManagers')->with('success', '書籍管理者が追加されました。');
        } elseif ($request->action == 'edit') {
            $manager = BookManager::findOrFail($request->manager_id);
            $manager->name = $request->name;
            $manager->bookAdminID = $request->bookAdminID;
            if ($request->filled('password')) {
                $manager->password = bcrypt($request->password);
            }
            $manager->save();
            return redirect()->route('admin.manageBookManagers')->with('success', '書籍管理者が更新されました。');
        } else {
            return back()->withErrors(['action' => '無効なアクションです。']);
        }
    }

    public function deleteBookManager($id)
    {
        $manager = BookManager::findOrFail($id);
        $manager->delete();
        return response()->json(['success' => true]);
    }


    // 監査ログ管理ページを表示するメソッド
    public function manageAuditLogs(Request $request)
    {
        // 全ての監査ログを取得する
        $auditLogs = AuditLogs::with('user');

        // パラメータによるフィルタリング（設定されている場合）
        if ($request->filled('user_id')) {
            $auditLogs->where('user_id', $request->user_id);
        }
        if ($request->filled('action')) {
            $auditLogs->where('action', 'like', '%' . $request->action . '%');
        }
        if ($request->filled('date_from')) {
            $auditLogs->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $auditLogs->whereDate('created_at', '<=', $request->date_to);
        }

        // フィルタを考慮したログの取得
        $auditLogs = $auditLogs->get();

        $adminName = $this->adminName;

        // 監査ログ管理ページのビューを返す
        return view('admin.manageAuditLogs', compact('auditLogs'), ['adminName' => $adminName]);
    }
}
