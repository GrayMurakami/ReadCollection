@extends('layouts.bookManager')

@section('content')

<div class="mt-4">
  <div class="text-center mt-5 pt-5">
    @if(Session::has('bookManager'))
    @php
    $bookManager = Session::get('bookManager');
    @endphp
    <h1>{{ $bookManager->name }}さん、こんにちは！</h1>
    @endif
  </div>
</div>

<div class="content mt-4">
  <h1 class="text-center px-5">『 お問い合わせ 』</h1>
  <div class="container mt-5" style="max-width: 900px; margin: 0 auto;">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">

            @if(session('success'))
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

            <form method="POST" action="{{ route('contact.send') }}">
              @csrf
              <div class="form-group border-bottom border-dark-subtle">
                <div class="ms-3">
                  以下フォームより、お気軽にお問い合わせください。
                </div>
                <div class="ms-3">
                  お問い合わせ内容の確認後、送信ボタンを押してください。
                </div>
              </div>
              <div class="form-group mt-4">
                <label for="firstName">
                  <span class="customStyle">※必須</span>　•　名前
                </label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="例: 田中" required>
              </div>
              <div class="form-group">
                <label for="phone">
                  <span class="customStyle">※必須 </span>　✆　電話番号
                </label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="90 2233 4455" required>
              </div>
              <div class="form-group">
                <label for="email">
                  <span class="customStyle">※必須</span>　✉　メールアドレス
                </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="mail@example.com" required>
              </div>
              <div class="form-group">
                <label for="message">
                  <span class="customStyle">※必須</span>　🖋　お問い合わせ内容
                </label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
              </div>
              <div class="row col-3 mx-auto">
                <button type="submit" class="btn btn-primary btn-lg my-3 fw-bold">送信</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection