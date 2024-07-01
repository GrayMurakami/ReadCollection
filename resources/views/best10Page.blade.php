@extends('layouts.appHomePage')

@section('content')

<style>
  ul {
    list-style-type: none;
    /* Отключить маркеры */
  }

  .move-pic {
    margin: 20px 0 20px 300px;
    padding: 1px;
  }

  .move-pic:hover {
    transition: transform 0.3s ease;
    /* 変更時のアニメーションの追加 */
    transform: scale(1.2);
  }

  .move-text {
    margin: 50px 0 0 20px;
  }

  .move-text:hover {
    transition: transform 0.3s ease;
    /* 変更時のアニメーションの追加 */
    transform: scale(1.1);
  }

  .text-with-shadow {
    text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5);
    /* 水平シフト、垂直シフト、ブラー、カラー */
  }
</style>

<div class="content">
  <h1 class="textDesignHome">『 ベスト10 』</h1>
  <ul>
    @foreach($selectedBestBooks as $book)
    <li>
      <div class="row">

        <div class="col-auto move-pic border border-1 border-white">
          <a href="{{ route($book['route']) }}">
            <img src="{{ asset($book['cover_image']) }}" alt="{{ $book['title'] }} Cover" style="width: 100px; height: 150px;">
          </a>
        </div>

        <div class="col-auto move-text text-white">
          <a href="{{ route($book['route']) }}" class="text-white text-decoration-none">
            <div class="fs-3 mb-2 text-with-shadow">
              « {{ $book['title'] }} »
            </div>
            <div class="fs-4"> <strong class="me-1">著者 : </strong>
              {{ $book['author'] }}
            </div>
          </a>
        </div>

      </div>
    </li>
    @endforeach
  </ul>
</div>

@endsection