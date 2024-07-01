@extends('layouts.admin')

@section('content')

<div class="text-center mb-5 mt-2">
  <h1>{{ $adminName }}さん、こんにちは！</h1>
  <h1 class="border-bottom">Manage Audit logs</h1>
</div>

<div class="container mb-5 pb-5">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card mt-5">
        <div class="card-header fs-3 text-center refreshCust with-shadow">監査ログ管理</div>
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

          <!-- ログ用フィルター -->
          <form method="GET" action="{{ route('admin.manageAuditLogs') }}">
            <div class="form-row mt-3">
              <div class="form-group col-md-3 px-4">
                <label for="user_id" class="fs-5 mb-n1">ユーザーID</label>
                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ request('user_id') }}">
              </div>
              <div class="form-group col-md-3 px-4">
                <label for="action" class="fs-5 mb-n1">アクション</label>
                <input type="text" name="action" id="action" class="form-control" value="{{ request('action') }}">
              </div>
              <div class="form-group col-md-3 px-4">
                <label for="date_from" class="fs-5 mb-n1">開始日</label>
                <input type="text" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="年ー月ー日">
              </div>
              <div class="form-group col-md-3 px-4">
                <label for="date_to" class="fs-5 mb-n1">終了日</label>
                <input type="text" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}" placeholder="年ー月ー日">
              </div>
            </div>
            <button type="submit" class="btn btn-info text-bg-info mb-4 mt-3 ms-4 fw-bold custUserBtn">フィルタリング</button>
          </form>

          <!-- ログ表 -->
          <table class="table mt-4">
            <thead>
              <tr>
                <th>№</th>
                <th>ユーザーID</th>
                <th>アクション</th>
                <th>詳細</th>
                <th>作成日</th>
              </tr>
            </thead>
            <tbody>
              @foreach($auditLogs as $log)
              <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->user_id }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<!-- フォーム・フィールドの値をリセットするJavaScriptコード -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // ページロード時にフォームフィールドの値をリセットする
    document.getElementById('user_id').value = '';
    document.getElementById('action').value = '';
    document.getElementById('date_from').value = '';
    document.getElementById('date_to').value = '';
  });

  document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#date_from", {
      dateFormat: "Y-m-d", // 日付の書式, yyyy-mm-dd
      locale: "ja", // カレンダーの言語（ここでは日本語）
    });
    flatpickr("#date_to", {
      dateFormat: "Y-m-d", // 日付の書式, yyyy-mm-dd
      locale: "ja", // カレンダーの言語（ここでは日本語）
    });
  });
</script>