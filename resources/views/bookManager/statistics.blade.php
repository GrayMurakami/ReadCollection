@extends('layouts.bookManager')

@section('content')
<div class="text-center mt-5 pt-5">
  @if(Session::has('bookManager'))
  @php
  $bookManager = Session::get('bookManager');
  @endphp
  <h1 class="mt-5">{{ $bookManager->name }}さん、こんにちは！</h1>
  @endif
  <h1 class="border-bottom">Books Statistics</h1>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container mt-5 px-5">
  <h1 class="text-center refreshCust with-shadow">書籍統計</h1>
  <div class="card mb-3">
    <div class="card-header fs-4">全体情報</div>
    <div class="card-body fs-5 mx-5 my-5">
      <p class="border-bottom">総書籍数: <strong class="fs-4 mx-2 text-danger">{{ $booksCount }}</strong></p>
      <p class="border-bottom">総著者数: <strong class="fs-4 mx-2 text-danger">{{ $authorsCount }}</strong></p>
      <p class="border-bottom">総ジャンル数: <strong class="fs-4 mx-2 text-danger">{{ $genresCount }}</strong></p>
      @if($latestBook)
      <p class="border-bottom">最新追加書籍: <strong class="fs-4 mx-2 text-danger">{{ $latestBook->title }}</strong> ({{ $latestBook->created_at->format('Y-m-d') }})</p>
      @else
      <p>追加された書籍はありません。</p>
      @endif
      @if($newestBook)
      <p class="border-bottom">最新刊の書籍: <strong class="fs-4 mx-2 text-danger">{{ $newestBook->title }} ({{ $newestBook->publication_date }})</strong></p>
      @else
      <p>刊行された書籍はありません。</p>
      @endif
      @if($oldestBook)
      <p class="border-bottom">最も古い書籍: <strong class="fs-4 mx-2 text-danger">{{ $oldestBook->title }} ({{ $oldestBook->publication_date }})</strong></p>
      @else
      <p>古い書籍はありません。</p>
      @endif
      @if($latestAddedBook)
      <p class="border-bottom">最新追加された書籍: <strong class="fs-4 mx-2 text-danger">{{ $latestAddedBook->title }}</strong>({{ $latestAddedBook->created_at->format('Y-m-d') }})</p>
      @else
      <p>最新の追加書籍はありません。</p>
      @endif
      @if($latestEditedBook)
      <p class="border-bottom">最新編集された書籍: <strong class="fs-4 mx-2 text-danger">{{ $latestEditedBook->title }}</strong>({{ $latestEditedBook->updated_at->format('Y-m-d') }})</p>
      @else
      <p>最新の編集書籍はありません。</p>
      @endif
      @if($latestDeletedBook)
      <p class="border-bottom">最新削除された書籍: <strong class="fs-4 mx-2 text-danger">{{ $latestDeletedBook->title }}</strong>({{ $latestDeletedBook->deleted_at ? $latestDeletedBook->deleted_at->format('Y-m-d') : '日付は不明' }})</p>
      @else
      <p>最新の削除書籍はありません。</p>
      @endif
      <p class="border-bottom">最も人気のある著者: <strong class="fs-4 mx-2 text-danger">{{ $mostPopularAuthor }}</strong></p>
      <p class="border-bottom">最も人気のあるジャンル: <strong class="fs-4 mx-2 text-danger">{{ $mostPopularGenre }}</strong></p>
    </div>
  </div>
</div>
@endsection