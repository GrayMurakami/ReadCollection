@extends('layouts.admin')

@section('content')

<div class="text-center mb-5 mt-2 pb-2">
  <h1>{{ $adminName }}さん、こんにちは！</h1>
</div>

<div class="container mt-5 pb-5">

  <div class="card-deck mb-5">
    <div class="card mx-4">
      <div class="card-body">
        <h5 class="card-title fw-bold mb-4">ユーザー管理</h5>
        <p class="card-text">登録済みのユーザーを管理します。</p>
        <div>
          <ul>
            <li>追加</li>
            <li>編集</li>
            <li>削除</li>
          </ul>
        </div>
        <div class="text-center mb-2">
          <a href="{{ route('admin.manageUsers') }}" class="btn btn-primary fw-bold">移動する</a>
        </div>
      </div>
    </div>
    <div class="card mx-4">
      <div class="card-body">
        <h5 class="card-title fw-bold mb-4">書籍管理者管理</h5>
        <p class="card-text">システムの書籍管理者を管理します。</p>
        <div>
          <ul>
            <li>追加</li>
            <li>編集</li>
            <li>削除</li>
          </ul>
        </div>
        <div class="text-center mb-2">
          <a href="{{ route('admin.manageBookManagers') }}" class="btn btn-primary fw-bold">移動する</a>
        </div>
      </div>
    </div>
    <div class="card mx-4">
      <div class="card-body">
        <h5 class="card-title fw-bold mb-4">監査ログ管理</h5>
        <p class="card-text">システムのログを閲覧および管理します。</p>
        <div>
          <ul>
            <li>ログの表示</li>
            <li>フィルタリング</li>
            <li>詳細確認</li>
          </ul>
        </div>
        <div class="text-center mb-2">
          <a href="{{ route('admin.manageAuditLogs') }}" class="btn btn-primary fw-bold">移動する</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection