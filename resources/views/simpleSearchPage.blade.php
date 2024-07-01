@extends('layouts.appHomePage')

@section('content')
<div class="content simple-search-link">
  <h1 class="textDesignHome" style="margin-left:500px;">『 簡易検索 』</h1>

  <!-- 検索バー -->
  <div class="search-bar mt-4 p-2 border bg-white" style="max-width: 600px; margin: 0 auto;">
    <div class="row g-0 align-items-center">
      <div class="col-auto">
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            タイトル
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item search-option" href="#" data-search-type="title">タイトル</a></li>
            <li><a class="dropdown-item search-option" href="#" data-search-type="author">著者</a></li>
            <li><a class="dropdown-item search-option" href="#" data-search-type="publication_date">出版年</a></li>
            <li><a class="dropdown-item search-option" href="#" data-search-type="genre">ジャンル</a></li>
          </ul>
        </div>
      </div>
      <div class="col">
        <input type="text" class="form-control" id="search-input" placeholder="検索...">
      </div>
      <div class="col-auto">
        <button class="btn btn-outline-info" type="button" id="search-button">
          <i class="fas fa-search"></i> 検索
        </button>
      </div>
      <div class="col-auto">
        <button class="btn btn-outline-danger" type="button" id="clear-button">
          <i class="fas fa-times"></i> クリア
        </button>
      </div>
    </div>
  </div>

  <!-- 検索結果の表示 -->
  <div class="search-results mt-4">
    <p id="search-results-count" class="d-none mx-5 px-5 fs-4 fw-bold text-white">
      <span class="search-result-label" style="display: inline-block; border-bottom: 3px solid #fff; margin-right: 10px;">検索結果 </span>：<span id="results-count"></span>件
    </p>
    <div id="results-list" class="list-group mb-5" style="max-width: 600px; margin: 0 auto;"></div>
  </div>

  <!-- エラー出力 -->
  <div id="error-message" class="mt-4 text-danger d-none"></div>
</div>

<!-- Include Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<script>
  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded event fired');

    let searchType = 'title';

    document.querySelectorAll('.search-option').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        searchType = this.getAttribute('data-search-type');
        document.querySelector('#dropdownMenuButton').textContent = this.textContent;
      });
    });

    document.querySelector('#search-button').addEventListener('click', performSearch);
    document.querySelector('#search-input').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        performSearch();
      }
    });

    document.querySelector('#clear-button').addEventListener('click', clearSearch);

    function clearSearch() {
      console.log('Clearing search input and results');
      document.querySelector('#search-input').value = '';
      document.querySelector('#results-list').innerHTML = '';
      document.querySelector('#search-results-count').classList.add('d-none');
      document.querySelector('#error-message').classList.add('d-none');
    }

    function performSearch() {
      const query = document.querySelector('#search-input').value;
      if (!query) return;

      fetch('/simpleSearch', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            type: searchType,
            query: query
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
                            <h5><strong>タイトル：　${book.title}</strong></h5>
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
        console.log('Pageshow event fired - clearing search');
        clearSearch();
      }
    });
  });
</script>

@endsection