<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>DC</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" integrity="sha384-RxqHG2ilm4r6aFRpGmBbGTjsqwfqHOKy1ArsMhHusnRO47jcGqpIQqlQK/kmGy9R" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
  @vite(['resources/css/topPage.css', 'resources/js/topPage.js', 'resources/js/login.js', 'resources/js/register.js', 'resources/js/modalWindows.js', 'resources/js/resetPassword.js'])
</head>

<body>

  <!--ヘッダー部-->
  <header class="p-3 text-bg-dark">
    <div class="container mx-3">
      <div class="d-flex flex-wrap align-items-center justify-content-between">

        <!-- ロゴ -->
        <a href="/" class="my-4 mb-lg-0 text-white text-decoration-none bi me-3">
          <img src="{{asset ('storage/images/logo.bmp')}}" class="logoScaleRotate" alt="logoHeader" />
        </a>

        <!-- サイト名 -->
        <ul class="nav col-12 col-lg-auto me-lg-auto justify-content-center mb-md-5 px-5 mt-n2">
          <li><a href="/" class="siteNameScale nav-link px-2 text-white fs-3 text-shadow">読書コレクション</a></li>
        </ul>

        <!-- ボタン -->
        <div class="text-end position-absolute top-0 end-0 my-3 mx-4 px-2">
          <button type="button" class="btn btn-outline-light me-4" data-bs-toggle="modal" data-bs-target="#registerModal">登録</button>
          <button type="button" class="btn btn-info me-4" data-bs-toggle="modal" data-bs-target="#loginModal">ログイン</button>
          <div class="dropdown d-inline-block">
            <button class="btn btn-danger" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              管理
            </button>
            <ul class="dropdown-menu dropStyle" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminLoginModal">管理者</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#bookAdminLoginModal">書籍管理者</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- 登録のモーダルウィンドウ -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modalMainText" id="registerModalLabel">登録</h5>
          <div class="actionDescript  mx-n1 pt-3">
            お名前、メールアドレス、パスワードを入力して、</br>
            サイトに登録してログインしてください。
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-4 mx-5">
          <!-- 登録フィールド -->
          <div class="container">
            <form action="/userRegister" method="POST" id="registerForm">
              @csrf
              <!-- 入力フィールド -->
              <!-- 名前 -->
              <div class="mb-3">
                <label for="name" class="form-label mb-n1">
                  <span class="customStyle">必須</span> 名前
                </label>
                <input type="text" class="form-control" id="name" name="name" placeholder="例: 田中" autocomplete="username" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <!-- メールアドレス -->
              <div class="mb-3">
                <label for="emailRegister" class="form-label mb-n1">
                  <span class="customStyle">必須</span> メールアドレス
                </label>
                <input type="email" class="form-control" id="emailRegister" name="email" placeholder="mail@example.com" autocomplete="email" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <!-- メールアドレス確認 -->
              <div class="mb-3">
                <label for="email_confirmation" class="form-label mb-n1">
                  <span class="customStyle">必須</span> メールアドレス確認
                </label>
                <input type="email" class="form-control" id="email_confirmation" name="email_confirmation" required>
                @error('email_confirmation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <!-- パスワード -->
              <div class="mb-3">
                <label for="passwordRegister" class="form-label mb-n1">
                  <span class="customStyle">必須</span> パスワード
                </label>
                <div class="input-group">
                  <input type="password" class="form-control" id="passwordRegister" name="password" placeholder="パスワード" required>
                  @error('password')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                  <button type="button" class="btn btn-outline-secondary" id="togglePasswordRegister">
                    <i class="bi bi-eye-slash" id="toggleIconRegister"></i>
                  </button>
                </div>
              </div>

              <!-- パスワード確認 -->
              <div class="mb-3">
                <label for="password_confirmation" class="form-label mb-n1">
                  <span class="customStyle">必須</span> パスワード確認
                </label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                  @error('password_confirmation')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                  <button type="button" class="btn btn-outline-secondary" id="togglePasswordRegister2">
                    <i class="bi bi-eye-slash" id="toggleIconRegister2"></i>
                  </button>
                </div>
              </div>

              <!-- チェックボックス -->
              <div class="ms-3 ps-3 my-4 form-check">
                <input type="checkbox" class="form-check-input ms-3 mt-3" id="agreeTerms" name="agreeTerms">
                <label class="custom-label" for="agreeTerms">
                  個人情報の取り扱いに関する<br>
                  契約条件に同意します。
                </label>
              </div>

              <!-- ボタンフィールド -->
              <button type="submit" id="registerButton" class="btn btn-primary btn-custom btn-register float-end mx-2 mt-n4" disabled>登録</button>
            </form>
          </div>
          <div class="mt-5 ms-4 mb-3 pt-5">
            既にアカウントをお持ちですか？<a href="#" id="loginLink" class="custom-link" data-bs-toggle="modal" data-bs-target="#loginModal"> ログイン </a>する。</br>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ログインのモーダルウィンドウ -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modalMainText" id="loginModalLabel">ログイン</h5>
          <div class="actionDescript  mx-n4 pt-3">
            サイトにログインするために登録された </br>
            メールアドレスとパスワードを入力してください。
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-4 mx-5">
          <!-- ログインフィールド -->
          <form action="/userLoginN" method="POST" id="loginForm">
            @csrf
            <!-- 入力フィールド -->
            <div class="input-group mb-3">
              <input type="email" class="form-control" id="emailLogin" name="email" placeholder="メールアドレス" autocomplete="email" required>
              @error('email')
              <div class="text-danger">{{ $message }}</div>
              @enderror
              <div class="input-group mb-3 mt-3">
                <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="パスワード" required>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="button" class="btn btn-outline-secondary" id="togglePasswordLogin">
                  <i class="bi bi-eye-slash" id="toggleIconLogin"></i>
                </button>
              </div>
            </div>
            <!-- ボタンフィールド -->
            <div class="container mt-2">
              <div class="d-inline-flex align-items-center">
                <button type="button" id="loginButton" class="btn btn-primary btn-custom btn-login mx-n3">ログイン</button>
                <a href="#" id="resetPasswordLink" class="custom-link" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                  <div class="ms-5 ps-5">パスワードをお忘れですか？
                  </div>
                </a>
              </div>
            </div>
          </form>
        </div>
        <div class="mt-3 ms-5 ps-3 mb-3">
          サイトにログインするために<a href="#" id="registerLink" class="custom-link" data-bs-toggle="modal" data-bs-target="#registerModal"> 登録 </a>された </br>
          メールアドレスとパスワードを入力してください。
        </div>
      </div>
    </div>
  </div>

  <!-- 再設定のモーダルウィンドウ -->
  <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modalMainText" id="resetPasswordModalLabel">再設定</h5>
          <div class="actionDescript  mx-n4 pt-3">
            パスワードをお忘れの場合は、登録されたメール </br>
            アドレスにリクエストを送信して再設定できます。
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-4 mx-5">
          <!-- ログインフィールド -->
          <form action="{{ route('password.reset') }}" method="POST" id="resetPasswordForm">
            @csrf
            <!-- 入力フィールド -->
            <div class="input-group mb-3">
              <input type="email" class="form-control" id="resetPasswordEmail" name="resetPasswordEmail" placeholder="メールアドレス" autocomplete="email" required>
            </div>
            @error('resetPasswordEmail')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- ボタンフィールド -->
            <div class="container mt-2">
              <div class="d-inline-flex align-items-center float-end mt-2">
                <button type="submit" class="btn btn-primary btn-custom mx-n3">送信</button>
              </div>
            </div>
          </form>

          <!-- 送信成功またはエラーメッセージの表示 -->
          @if(session('success'))
          <div class="alert alert-success">{{ session('成功 ❕') }}</div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger">{{ session('エラー ❕') }}</div>
          @endif

        </div>
        <div class="mt-3 ms-5 ps-3 mb-3">
          こちらは初めてですか。</br>
          それでは、<a href="#" id="registerLink" class="custom-link" data-bs-toggle="modal" data-bs-target="#registerModal"> 登録 </a> していただけます。
        </div>
      </div>
    </div>
  </div>

  <!-- 管理者のモーダルウィンドウ -->
  <div class="modal fade" id="adminLoginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modalMainText" id="adminLoginModalLabel">管理画面ログイン</h5>
          <div class="actionDescript mx-n5 pt-3">
            管理者のIDとパスワードを入力してください。
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-4 mx-5">
          <!-- ログインフィールド -->
          <form action="{{ route('adminLogin') }}" method="POST" id="adminLoginForm">
            @csrf
            <!-- 入力フィールド -->
            <div class="input-group mb-3">
              <span class="input-group-text custom-bg" id="adminIDLabel">管理者ID</span>
              <input type="text" class="form-control" id="adminID" name="adminID" autocomplete="adminID" aria-describedby="adminIDLabel">
            </div>
            <div class="input-group mb-3 mt-3">
              <span class="input-group-text custom-bg" id="adminPasswordLabel">パスワード</span>
              <input type="password" class="form-control" id="adminPassword" name="adminPassword" aria-describedby="adminPasswordLabel">
              <button type="button" class="btn btn-outline-secondary" id="toggleAdminPassword">
                <i class="bi bi-eye-slash" id="toggleIconAdmin"></i>
              </button>
            </div>
            <!-- ボタンフィールド -->
            <div class="container pt-2">
              <div class="row justify-content-center">
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary btn-success btn-custom mx-n3 mb-3">🔒 ログイン</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- 書籍管理者のモーダルウィンドウ -->
  <div class="modal fade" id="bookAdminLoginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modalMainText" id="bookAdminLoginModalLabel">書籍管理画面ログイン</h5>
          <div class="actionDescript mx-n5 pt-3">
            書籍管理者のIDとパスワードを入力してください。
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-4 mx-5">
          <!-- ログインフィールド -->
          <form action="{{ route('bookAdminLogin') }}" method="POST" id="bookAdminLoginForm">
            @csrf
            <!-- 入力フィールド -->
            <div class="input-group mb-3">
              <span class="input-group-text custom-bg" id="bookAdminIDLabel">書籍者ID</span>
              <input type="text" class="form-control" id="bookAdminID" name="bookAdminID" autocomplete="bookAdminID" aria-describedby="bookAdminIDLabel">
            </div>
            <div class="input-group mb-3 mt-3">
              <span class="input-group-text custom-bg" id="bookAdminPasswordLabel">パスワード</span>
              <input type="password" class="form-control" id="bookAdminPassword" name="bookAdminPassword" aria-describedby="adminPasswordLabel" bookAdminPasswordLabel>
              <button type="button" class="btn btn-outline-secondary" id="toggleBookAdminPassword">
                <i class="bi bi-eye-slash" id="toggleIconBookAdmin"></i>
              </button>
            </div>
            <!-- ボタンフィールド -->
            <div class="container my-2 pt-2">
              <div class="row justify-content-center">
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary btn-success btn-custom mx-n3">🔒 ログイン</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--メインコンテンツ部-->
  <div class="content">
    <h1 class="textDesign">『<b>読書コレクション</b>』のウェブサイトへようこそ！</h1>
    <div class="textDescript">
      <p>私たちは、詳細な説明付きの幅広い書籍コレクションを提供しています。</br>
        サイトに登録後、簡単に興味のある本を見つけるための検索機能を </br>
        ご利用いただけます。本の詳細や著者、ジャンルなど、必要な情報を </br>
        すべて知ることができます。
      </p>
      <p>
        また、新しい書籍をカタログに追加するための提案を </br>
        お待ちしています。アイデアや提案を共有するために、</br>
        サイトの管理者にお問い合わせください。
      </p>
      <p>
        読書コレクションで楽しく、</br>
        知識を深める読書をお楽しみください！
      </p>
    </div>
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

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex mx-n5">
        <li class="ms-3">
          <a class="bi" href="https://github.com/GrayMurakami">
            <img src="{{ asset('/storage/images/githubIcon.png')}}" class="linkIcon" width="35" height="35" alt="gitHubIcon" />
          </a>
        </li>
      </ul>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>