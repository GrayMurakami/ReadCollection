@extends('layouts.admin')

@section('content')

<div class="text-center mb-5 mt-2">
  <h1>{{ $adminName }}さん、こんにちは！</h1>
  <h1 class="border-bottom">Manage Users</h1>
</div>

<div class="container mb-5 pb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mt-5">
        <div class="card-header fs-3 text-center refreshCust with-shadow">ユーザー管理</div>
        <div class="card-body">

          <!-- フラッシュメッセージ -->
          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <!-- ユーザー管理用のフォーム -->
          <form id="userForm" method="POST" action="{{ route('admin.process') }}">
            @csrf
            <!-- データ転送のための隠しフィールド -->
            <input type="hidden" name="action" id="action">
            <input type="hidden" name="user_id" id="user_id">

            <div style="max-width: 500px; margin: 0 auto;">
              <!-- 行動の選択 -->
              <div class="form-group mt-4">
                <label for="action" class="fs-4 mb-n1v">行動の選択:</label>
                <select name="action" id="actionSelect" class="form-control" required>
                  <option value="add">ユーザーを追加する</option>
                  <option value="edit">ユーザーを編集する</option>
                </select>
              </div>

              <!-- ユーザーを追加/編集するためのフィールド -->
              <div class="form-group">
                <label for="name" class="mt-3 fs-5 mb-n1">ユーザー名:</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="email" class="mt-1 fs-5 mb-n1">Eメール:</label>
                <input type="email" name="email" id="email" class="form-control" required autocomplete="email">
              </div>
              <div class="form-group">
                <label for="password" class="mt-1 fs-5 mb-n1">パスワード:</label>
                <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
              </div>
              <div class="form-group">
                <label for="password_confirmation" class="mt-1 fs-5 mb-n1">パスワードの確認:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
              </div>

            </div>

            <!-- フォーム送信ボタン -->
            <div class="text-center">
              <button type="submit" class="btn btn-info text-bg-info mt-4 mb-5 px-3 fw-bold custBtn">実行</button>
            </div>

          </form>

          <div class="mb-4" style="max-width: 600px; margin: 0 auto;">
            <!-- ユーザーを表示するための表 -->
            <table class="table mt-5">
              <thead>
                <tr class="fs-5">
                  <th>名前</th>
                  <th>Eメール</th>
                  <th>行動　【アクション】</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>
                    <div class="mt-2">{{ $user->name }}</div>
                  </td>
                  <td>
                    <div class="mt-2">{{ $user->email }}</div>
                  </td>
                  <td>
                    <!-- ユーザーを編集、削除するためのボタン -->
                    <button type="button" class="btn btn-warning text-bg-warning edit-btn px-3 me-4 fw-bold custUserBtn" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}">編集</button>
                    <button type="button" class="btn btn-danger delete-btn px-3 fw-bold custUserBtn" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">削除</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection