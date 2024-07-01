@extends('layouts.bookManager')

@section('content')

<div class="text-center mb-5 mt-2">
  @if(Session::has('bookManager'))
  @php
  $bookManager = Session::get('bookManager');
  @endphp
  <h1>{{ $bookManager->name }}さん、こんにちは！</h1>
  @endif
</div>

<div class="container px-5">

  <div class="row mb-5">
    <!-- 書籍管理 -->
    <div class="col-md-3 mx-auto">
      <div class="card">
        <div class="card-header fs-4">本の管理</div>
        <div class="card-body">
          <div>サイトにアップロードされた</div>
          <div class="mb-3">すべての書籍を管理します。</div>
          <div>
            <ul>
              <li>追加</li>
              <li>編集</li>
              <li>削除</li>
            </ul>
          </div>
          <div class="text-center mb-2">
            <a href="/bookManagerDashboard/bookManagePage" class="btn btn-primary">書籍管理ページへ</a>
          </div>
        </div>
      </div>
    </div>

    <!-- 書籍数の管理 -->
    <div class="col-md-3 mx-auto">
      <div class="card">
        <div class="card-header fs-4">書籍数の管理</div>
        <div class="card-body">
          <div>サイトにアップロードされた</div>
          <div class="">書籍の数は <strong class="fs-4 text-danger mx-1"> {{ $booksCount }} </strong> 冊です。</div>
        </div>
        <img src="{{asset ('storage/images/bookManagerDashboard.jpg')}}" alt="BooksPic" />
      </div>
    </div>
  </div>

  <div class="row mb-5">
    <!-- グラフと図表の管理 -->
    <div class="col-md-3 mx-auto">
      <div class="card">
        <div class="card-header fs-4">グラフの管理</div>
        <div class="card-body">
          <div class="mb-3">グラフを表示します。</div>
          <div class="text-center mb-2">
            <a href="/bookManagerDashboard/statisticsGraphs" class="btn btn-primary">グラフ管理ページへ</a>
          </div>

        </div>
        <img src="{{asset ('storage/images/graphs.png')}}" class="mt-n3" alt="GraphsPic" />
      </div>
    </div>

    <!-- 書籍統計の管理 -->
    <div class="col-md-3 mx-auto mt-5">
      <div class="card">
        <div class="card-header fs-4">書籍統計の管理</div>
        <div class="card-body">
          <div>サイトにアップロードされた</div>
          <div class="mb-3">書籍の統計情報を表示します。</div>
          <div>
            <ul>
              <li>表示</li>
              <li>分析</li>
            </ul>
          </div>
          <div class="text-center mb-2">
            <a href="/bookManagerDashboard/statistics" class="btn btn-primary">統計管理ページへ</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

@endsection