@extends('layouts.bookManager')

@section('content')
<div class="text-center mb-5 mt-2">
  @if(Session::has('bookManager'))
  @php
  $bookManager = Session::get('bookManager');
  @endphp
  <h1>{{ $bookManager->name }}さん、こんにちは！</h1>
  @endif
  <h1 class="border-bottom">Manage Books</h1>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="ms-5 fs-3 fw-bold mb-5">
  <a href="{{ route('books.manage') }}" class="refreshCust with-shadow">ページを更新</a>
</div>

{{-- 書籍追加フォーム --}}
<form action="{{ route('books.add') }}" method="POST" id="addForm" enctype="multipart/form-data">
  @csrf
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center ms-2">

      <div class="col-md-6">
        <div class="row">

          <div class="col-md-6">
            <div class="mb-4 pe-5">
              <label>タイトル:</label>
              <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-4 pe-5">
              <label>著者:</label>
              <input type="text" name="author" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-4 pe-5">
              <label>出版年:</label>
              <input type="text" name="publication_date" class="form-control" required>
            </div>
            <div class="mb-4 pe-5">
              <label>ジャンル:</label>
              <input type="text" name="genre" class="form-control" required>
            </div>
          </div>

        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-5">
          <label>説明:</label>
          <textarea name="description" class="form-control custom-textarea"></textarea>
        </div>
        <div class="col">
          <label for="cover-image-input">表紙画像:</label>
          <input type="file" id="cover-image-input" name="cover_image" accept="image/*" style="display: none;">
          <button onclick="document.getElementById('cover-image-input').click(); return false;" class=" ms-3 btn btn-info border-dark p-1 px-2 fw-bold">ファイルを選択</button>
          <span id="file-status" class="ms-3 text-danger fs-6">ファイルが選択されていない</span>
        </div>
      </div>

    </div>
  </div>
  <!-- マネージャーIDを渡す隠しフィールドを追加 -->
  <input type="hidden" name="book_manager_id" value="{{ Session::get('bookManager')->id }}">

  <div class="text-center mb-5 me-4">
    <button type="submit" onclick="confirmAdd()" class="btn btn-success border-dark-subtle fw-bold">本を追加</button>
  </div>

</form>


<!-- セパレーター -->
<div class="between-us my-5"></div>


{{-- 編集や削除が可能な書籍のリスト --}}
<ul>
  @foreach ($books as $book)
  <li>
    <div class="fs-4">
      <strong class="fs-3 border-bottom border-dark">{{ $book->title }}</strong> by {{ $book->author }}
    </div>
    <form action="{{ route('books.edit.submit', $book->book_id) }}" method="POST" id="editForm" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="container mt-5 mb-5">
        <div class="row justify-content-center ms-2">

          <div class="col-md-6">
            <div class="row">

              <div class="col-md-6">
                <div class="mb-4 pe-5">
                  <label>タイトル:</label>
                  <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
                </div>
                <div class="mb-4 pe-5">
                  <label>著者:</label>
                  <input type="text" name="author" value="{{ $book->author }}" class="form-control" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-4 pe-5">
                  <label>出版年:</label>
                  <input type="text" name="publication_date" value="{{ $book->publication_date }}" class="form-control" required>
                </div>
                <div class="mb-4 pe-5">
                  <label>ジャンル:</label>
                  <input type="text" name="genre" value="{{ $book->genre }}" class="form-control" required>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-5">
              <label>説明:</label>
              <textarea name="description" class="form-control custom-textarea">{{ $book->description }}</textarea>
            </div>
            <div class="col">
              <label for="cover-image-input">表紙画像:</label>
              <input type="file" id="cover-image-input" name="cover_image" accept="image/*" style="display: none;">
              <button onclick="document.getElementById('cover-image-input').click(); return false;" class=" ms-3 btn btn-info border-dark p-1 px-2 fw-bold">ファイルを選択</button>
              <span id="file-status" class="ms-3 text-danger fs-6">ファイルが選択されていない</span>
            </div>
          </div>

        </div>
      </div>


      <div class="text-center me-4">
        <button type="submit" onclick="confirmEdit()" class="btn btn-warning text-dark-emphasis border-dark-subtle fw-bold">本を編集</button>
      </div>

    </form>

    <form action="{{ route('books.delete', $book->book_id) }}" method="POST" id="deleteForm">
      @csrf
      @method('DELETE')
      <div class="border-bottom mb-5">
        <div class="text-end me-5 pe-5 mt-n2 mb-3">
          本№{{ $book->book_id }}：
          <button type="button" onclick="confirmDelete()" class="btn btn-danger border-black fw-bold">削除</button>
        </div>
      </div>
    </form>
  </li>
  @endforeach
</ul>

<!-- セパレーター -->
<div class="between-us my-5"></div>

{{-- ページネーション --}}
<div class="d-flex justify-content-center">
  <ul class="pagination">
    {{-- ボタン "前に" --}}
    @if ($books->onFirstPage())
    <li class="page-item disabled">
      <span class="page-link">前に</span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">前に</a>
    </li>
    @endif

    {{-- 新しいページ --}}
    @for ($i = 1; $i <= $books->lastPage(); $i++)
      <li class="page-item{{ $books->currentPage() === $i ? ' active' : '' }}">
        <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
      </li>
      @endfor

      {{-- ボタン "次に" --}}
      @if ($books->hasMorePages())
      <li class="page-item">
        <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">次に</a>
      </li>
      @else
      <li class="page-item disabled">
        <span class="page-link">次に</span>
      </li>
      @endif
  </ul>
</div>

@endsection

<script>
  function confirmDelete() {
    if (confirm('本当にこの本を削除したいのですか？')) {
      document.getElementById('deleteForm').submit();
    }
  }

  function confirmEdit() {
    if (confirm('本当にこの本を編集したいのですか？')) {
      document.getElementById('editForm').submit();
    }
  }

  function confirmAdd() {
    if (confirm('本当にこの本を追加したいのですか？')) {
      document.getElementById('addForm').submit();
    }
  }

  // 画像ボタン
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cover-image-input').addEventListener('change', function() {
      let fileName = this.value.split('\\').pop();
      if (fileName) {
        document.getElementById('file-status').innerText = fileName;
      } else {
        document.getElementById('file-status').innerText = 'ファイルが選択されていない';
      }
    });
  });
</script>