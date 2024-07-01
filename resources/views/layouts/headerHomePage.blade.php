<style>
  .text-with-shadow {
    text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5);
    /* 水平シフト、垂直シフト、ブラー、カラー */
  }
</style>

<!--ヘッダー部-->
<header class="p-3 text-bg-dark">
  <div class="container mx-3">
    <div class="d-flex align-items-center">

      <!-- ロゴ -->
      <a href="/home" class="my-4 mb-lg-0 text-white text-decoration-none bi me-3">
        <img src="{{asset ('storage/images/logo.bmp')}}" class="logoScaleRotate" alt="logoHeader" />
      </a>

      <!-- サイト名 -->
      <ul class="nav col-12 col-lg-auto justify-content-center mb-md-5 px-5 mt-n2">
        <li><a href="/home" class="siteNameScale nav-link px-2 text-white fs-3 text-with-shadow">読書コレクション</a></li>
      </ul>


      <!-- 検索／書籍ボタン -->
      <!-- 追加されたボタン -->
      <div class="d-flex mt-n5 me-5 ms-5 px-5">
        <div class="dropdown mx-2 mt-n2">
          <button class="btn btn-outline-info btnBold dropdown-toggle text-white" type="button" id="searchDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            検索
          </button>
          <ul class="dropdown-menu" aria-labelledby="searchDropdown">
            <li><a class="dropdown-item simple-search-link" href="/simpleSearch">簡易検索</a></li>
            <li><a class="dropdown-item detail-search-link" href="/detailSearch">詳細検索</a></li>
          </ul>
        </div>

        <div class="vertical-line mx-2"></div>

        <div class="dropdown mx-2 mt-n2">
          <button class="btn btn-outline-info btnBold dropdown-toggle text-white" type="button" id="rankingDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            ランキング
          </button>
          <ul class="dropdown-menu" aria-labelledby="rankingDropdown">
            <li><a class="dropdown-item" href="/best10">ベスト10</a></li>
            <li><a class="dropdown-item" href="/mustRead">必読書</a></li>
            <li><a class="dropdown-item" href="/bestseller">ベストセラー</a></li>
          </ul>
        </div>
      </div>

      <div class="d-flex mt-n5 ms-5 header-buttons">
        @auth
        <button class="btnUser me-5 mb-2 badge d-flex align-items-center p-1 border border-primary-subtle rounded-pill" disabled style="white-space: nowrap;">
          <img class="rounded-circle me-2" src="{{ asset('storage/images/userIcon.webp') }}" alt="" style="width: 36px; height: 36px;">
          <span class="flex-grow-1 fs-5">{{ Auth::user()->name }}</span>
          <span class="me-2"></span> <!-- 空要素でインデントを増やす -->
        </button>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-danger btnBold ms-4 px-2">ログアウト</button>
        </form>
        @endauth
      </div>

    </div>
  </div>

</header>