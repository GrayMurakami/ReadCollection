@extends('layouts.appHomePage')

@section('content')

<style>
  /* 書籍コンテンツスタイル */
  .book-cover-wrapper {
    margin: 20px 0 0 1px;
    border: 2px solid #fff;
    padding: 5px;
  }

  .book-cover-wrapper:hover {
    transition: transform 0.3s ease;
    /* 変更時のアニメーションの追加 */
    transform: scale(1.3);
  }

  .book-details {
    padding-left: 20px;
    /* テキストの左インデント */
    margin-top: 20px;
  }

  .book-author,
  .book-genre,
  .book-publication-date {
    margin: 10px 0 20px 25px;
    /* 要素間のインデント */
    color: #fff;
    font-size: 20px;
  }

  .book-description {
    border: 3px solid #000;
    margin: 10px 0 20px 25px;
    padding: 10px;
    color: #fff;
    font-size: 20px;
    max-width: 450px;
    word-wrap: break-word;
    box-sizing: border-box;
  }
</style>

<div class="content">
  <h1 class="textDesignHome">『<b>{{ $book->title }}</b>』</h1>
  <div class="row">
    <div class="col-md-12 mb-5 ms-5 ps-5 mt-2">
      <div class="d-flex align-items-start">
        @if($book->cover_image)
        <div class="book-cover-wrapper">
          <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid book-cover" alt="{{ $book->title }}">
        </div>
        @endif
        <div class="book-details">
          <p class="book-author"><strong class="border-bottom p-1 me-3">著者: </strong> {{ $book->author }}</p>
          <p class="book-genre"><strong class="border-bottom p-1 me-3">ジャンル: </strong> {{ $book->genre }}</p>
          <p class="book-publication-date"><strong class="border-bottom p-1 me-3">出版年: </strong> {{ $book->publication_date }}年</p>
          <p class="book-description"><strong class="me-3">説明: </strong> {{ $book->description }}</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection