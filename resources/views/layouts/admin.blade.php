<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ダッシュボード</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" integrity="sha384-RxqHG2ilm4r6aFRpGmBbGTjsqwfqHOKy1ArsMhHusnRO47jcGqpIQqlQK/kmGy9R" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  @vite(['resources/css/dashboard.css', 'resources/css/adminPage.css', 'resources/js/manageUsers.js', 'resources/js/manageBookManagers.js']);
</head>

<body class="d-flex flex-column min-vh-100">

  <style>
    .text-with-shadow {
      text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5);
      /* 水平シフト、垂直シフト、ブラー、カラー */
    }
  </style>

  <!--ヘッダー部-->
  <header class="p-3 text-bg-dark">
    <div class="container mx-3">
      <div class="d-flex">

        <!-- ロゴ -->
        <a href="/adminDashboard" class="my-4 mb-lg-0 text-white text-decoration-none bi me-3">
          <img src="{{asset ('storage/images/logo.bmp')}}" class="logoScaleRotate" alt="logoHeader" />
        </a>

        <!-- サイト名 -->
        <div class="d-flex align-self-center mb-5">
          <a href="/adminDashboard" class="siteNameScale px-2 text-white fs-3 text-with-shadow ms-5 me-4">読書コレクション</a>
          <span class="ms-5 fs-2 fw-bold">管理者</span>
        </div>

        <div class="ml-auto">
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger btnBold ms-4 px-2 mt-1">ログアウト</button>
          </form>
        </div>

      </div>
    </div>

  </header>

  <!--メインコンテンツ-->
  <div class="container-fluid flex-grow-1" style="padding-top: 100px;">
    @yield('content')
  </div>

  <!--フッター部-->
  <footer class="footer-dark d-flex flex-wrap justify-content-between align-items-center py-2 mt-4">
    <div class="footerLine"></div>
    <div class="container d-flex justify-content-between mx-n1">
      <div class="col-md-4 d-flex align-items-center mx-3">
        <a href="/" class="mb-3 me-4 mb-md-0 text-body-secondary text-decoration-none lh-1">
          <img src="{{ asset('/storage/images/logoFooter.jpg')}}" class="bi footerLogo" width="35" height="35" alt="footerLogo" />
        </a>
        <span class="textColor mb-3 mb-md-0">© 2024 GraY</span>
      </div>

      <li class="nav justify-content-end mx-n5">
        <a class="bi" href="https://github.com/GrayMurakami">
          <img src="{{ asset('/storage/images/githubIcon.png')}}" class="linkIcon" width="35" height="35" alt="gitHubIcon" />
        </a>
      </li>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
</body>

</html>