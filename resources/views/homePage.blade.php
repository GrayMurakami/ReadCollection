@extends('layouts.appHomePage')

@section('content')

<style>
  .text-with-shadow {
    text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5);
    /* 水平シフト、垂直シフト、ブラー、カラー */
  }

  .calendar-icon {
    cursor: pointer;
    margin-left: 10px;
  }

  /* Скрываем текстовое поле */
  #date_now {
    display: none;
  }
</style>

<!-- ここにメインコンテンツ -->
<div class="content">
  <h1 class="textDesign">『<b>読書コレクション</b>』のウェブサイトへようこそ！</h1>
  <div class="row">
    @if(isset($randomBook))
    <div class="col-md-12 mb-5 ms-5 ps-5 mt-2 me-5">
      <div class="d-flex align-items-start">
        @if($randomBook->cover_image)
        <div class="book-cover-wrapper">
          @php
          $routeName = 'books.showBook' . $randomBook->book_id;
          @endphp
          <a href="{{ route($routeName) }}">
            <img src="{{ asset('storage/' . $randomBook->cover_image) }}" class="img-fluid book-cover" alt="{{ $randomBook->title }}">
          </a>
        </div>
        @endif
        <div class="book-details me-n5 pe-n5">
          <h5 class="book-title fw-bold text-with-shadow me-n5 pe-n5">
            <a href="{{ route($routeName) }}" style="text-decoration: none; color: inherit;">« {{ $randomBook->title }} »</a>
          </h5>
          <p class="book-author"><strong class="border-bottom p-1 me-3">著者: </strong> {{ $randomBook->author }}</p>
          <p class="book-genre"><strong class="border-bottom p-1 me-3">ジャンル: </strong> {{ $randomBook->genre }}</p>
          <p class="book-publication-date"><strong class="border-bottom p-1 me-3">出版年: </strong> {{ $randomBook->publication_date }}年</p>
        </div>

        <div class="col-md-3 mb-5 ps-5">
          <div class="row ms-4">
            <div class="col-md-12">
              <div class="other-content mt-5">
                <!-- カレンダーの絵が描かれたボタン -->
                <button type="button" id="calendarButton" class="calendar-icon">
                  <img src="{{ asset('storage/images/calendar.png') }}" alt="Calendar" width="60" height="60">
                </button>

                <!-- 日付を選択する隠しフィールド -->
                <input type="text" name="date_now" id="date_now" value="{{ request('date_now') }}">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    @else
    <p>ランダムブックはありません。</p>
    @endif
  </div>
</div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // カレンダーボタンをクリックしたときの処理
    document.getElementById('calendarButton').addEventListener('click', function() {
      // 日付入力フィールドのためのflatpickr
      flatpickr("#date_now", {
        dateFormat: "Y-m-d", // 日付のフォーマット: yyyy-mm-dd
        locale: "ja", // カレンダーの言語（日本語）
        appendTo: document.getElementById('calendarButton').parentElement, // カレンダーを配置する親要素
        onClose: function(selectedDates, dateStr, instance) {
          // カレンダーを閉じたときの処理
          console.log("カレンダーが閉じられました");
        }
      }).open(); // カレンダーを開く
    });
  });
</script>