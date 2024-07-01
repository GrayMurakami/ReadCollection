@extends('layouts.appHomePage')

@section('content')

<style>
  #search-input1 {
    width: 50%;
  }
</style>

<div class="content detail-search-page">
  <h1 class="textDesignHome" style="margin-left:500px;">『 詳細検索 』</h1>

  <div class="d-flex justify-content-end">
    <!-- 検索バー -->
    <div class="search-bar row mt-4 p-4 border bg-white" style="width: 800px; margin: 0 auto;">

      <!-- AND/ORロジック  -->
      <div class="col-md-auto align-self-center">
        <select class="form-select" id="and-or-selector">
          <option value="AND">AND</option>
          <option value="OR">OR</option>
        </select>
      </div>

      <!-- 検索バー -->
      <div class="col-md-auto">
        <div class="row">
          <div class="col">
            <div class="dropdown">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                タイトル
              </button>
              <ul class="dropdown-menu dropdown-menu-1" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item search-option-1" href="#" data-search-type="title" data-input-id="search-input1" data-bs-target="#search-input1">タイトル</a></li>
                <li><a class="dropdown-item search-option-1" href="#" data-search-type="author" data-input-id="search-input1" data-bs-target="#search-input1">著者</a></li>
                <li><a class="dropdown-item search-option-1" href="#" data-search-type="publication_date" data-input-id="search-input1" data-bs-target="#search-input1">出版年</a></li>
                <li><a class="dropdown-item search-option-1" href="#" data-search-type="genre" data-input-id="search-input1" data-bs-target="#search-input1">ジャンル</a></li>
              </ul>
            </div>
            <div class="dropdown">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                タイトル
              </button>
              <ul class="dropdown-menu dropdown-menu-2" aria-labelledby="dropdownMenuButton2">
                <li><a class="dropdown-item search-option-2" href="#" data-search-type="title" data-input-id="search-input2" data-bs-target="#search-input2">タイトル</a></li>
                <li><a class="dropdown-item search-option-2" href="#" data-search-type="author" data-input-id="search-input2" data-bs-target="#search-input2">著者</a></li>
                <li><a class="dropdown-item search-option-2" href="#" data-search-type="publication_date" data-input-id="search-input2" data-bs-target="#search-input2">出版年</a></li>
                <li><a class="dropdown-item search-option-2" href="#" data-search-type="genre" data-input-id="search-input2" data-bs-target="#search-input2">ジャンル</a></li>
              </ul>
            </div>
          </div>


          <div class="col-md-auto">
            <div class="">
              <input type="text" class="form-control" id="search-input1" placeholder="検索..." style="width: 170%;">
            </div>
            <div class="">
              <input type="text" class="form-control" id="search-input2" placeholder="検索..." style="width: 170%;">
            </div>
          </div>
        </div>
      </div>

      <!-- 検索ボタンと削除 -->
      <div class="col-md-auto offset-md-2 align-self-center">
        <div class="">
          <button class="btn btn-outline-info me-1" type="button" id="search-button">
            <i class="fas fa-search"></i> 検索
          </button>
          <button class="btn btn-outline-danger mx-1" type="button" id="clear-button">
            <i class="fas fa-times"></i> クリア
          </button>
        </div>
      </div>

    </div>

  </div>

</div>


<!-- 検索結果の表示 -->
<div class="search-results mt-4">
  <p id="search-results-count" class="d-none mx-5 px-5 fs-4 fw-bold text-white">
    <span class="search-result-label" style="display: inline-block; border-bottom: 3px solid #fff; margin-right: 10px;">検索結果 </span>：<span id="results-count"></span>件
  </p>
  <div id="results-list" class="list-group mb-5" style="max-width: 800px; margin: 0 auto;"></div>
</div>

<!-- エラー出力 -->
<div id="error-message" class="mt-4 text-danger d-none"></div>
</div>

<!-- Include Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let searchType1 = 'title';
    let searchType2 = 'title';

    document.querySelectorAll('.search-option-1').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const inputId = this.getAttribute('data-input-id');
        const searchType = this.getAttribute('data-search-type');
        if (inputId === 'search-input1') {
          searchType1 = searchType;
          document.querySelector('#dropdownMenuButton1').textContent = this.textContent;
        }
      });
    });

    document.querySelectorAll('.search-option-2').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const inputId = this.getAttribute('data-input-id');
        const searchType = this.getAttribute('data-search-type');
        if (inputId === 'search-input2') {
          searchType2 = searchType;
          document.querySelector('#dropdownMenuButton2').textContent = this.textContent;
        }
      });
    });

    document.querySelector('#search-button').addEventListener('click', performSearch);
    document.querySelectorAll('.form-control').forEach(input => {
      input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          performSearch();
        }
      });
    });

    document.querySelector('#clear-button').addEventListener('click', clearSearch);

    function clearSearch() {
      document.querySelector('#search-input1').value = '';
      document.querySelector('#search-input2').value = '';
      document.querySelector('#and-or-selector').value = 'AND';
      document.querySelector('#results-list').innerHTML = '';
      document.querySelector('#search-results-count').classList.add('d-none');
      document.querySelector('#error-message').classList.add('d-none');
    }

    function performSearch() {
      const query1 = document.querySelector('#search-input1').value;
      const query2 = document.querySelector('#search-input2').value;
      const andOr = document.querySelector('#and-or-selector').value;

      if (!query1 && !query2) return;

      fetch('/detailSearch', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            type1: searchType1,
            query1: query1,
            type2: searchType2,
            query2: query2,
            andOr: andOr
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            document.querySelector('#error-message').textContent = data.error;
            document.querySelector('#error-message').classList.remove('d-none');
            return;
          }

          const resultsList = document.querySelector('#results-list');
          resultsList.innerHTML = '';

          data.forEach(book => {
            const listItem = document.createElement('a');
            listItem.href = `/books/book${book.book_id}`;
            listItem.className = 'list-group-item list-group-item-action';
            const coverImage = `/storage/${book.cover_image}`;
            listItem.innerHTML = `
              <div class="d-flex">
                <div class="me-5">
                  <img src="${coverImage}" alt="${book.title}" style="width: 50px; height: 75px;">
                </div>
                <div class="fw-bold mt-2">
                  <h5><strong><a href="/books/book${book.book_id}">タイトル：　${book.title}</a></strong></h5>
                  <p>著者：　${book.author}</p>
                </div>
              </div>
            `;
            resultsList.appendChild(listItem);
          });

          document.querySelector('#results-count').textContent = data.length;
          document.querySelector('#search-results-count').classList.remove('d-none');
        })
        .catch(error => {
          document.querySelector('#error-message').textContent = 'An error occurred while searching.';
          document.querySelector('#error-message').classList.remove('d-none');
        });
    }

    // ページが表示されたときに、検索入力と検索結果を消去する（バックナビゲーションなど）
    window.addEventListener('pageshow', function(event) {
      if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        clearSearch();
      }
    });

  });
</script>


@endsection