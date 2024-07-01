// モーダルウィンドウを制御するJavaScript と　登録、ログインフォームの送信処理

document.addEventListener('DOMContentLoaded', function () {
  // モーダルウィンドウ要素の取得
  let registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
  let loginModal = new bootstrap.Modal(document.getElementById('loginModal'));

  // ボタンにイベントハンドラを割り当てる
  let registerButton = document.querySelector('.btn-register');
  let loginButton = document.querySelector('.btn-login');

  if (registerButton) {
      registerButton.addEventListener('click', function () {
          registerModal.show(); // 登録モーダルウィンドウを表示
      });
  } else {
      console.error("クラス 'btn-register' を持つ要素が見つかりません。");
  }

  if (loginButton) {
      loginButton.addEventListener('click', function () {
          loginModal.show(); // ログインモーダルウィンドウを表示
      });
  } else {
      console.error("クラス 'btn-login' を持つ要素が見つかりません。");
  }

  // 登録フォームの送信処理
  let registerForm = document.getElementById('registerForm');
  let registerSubmitButton = document.getElementById('registerButton');

  if (registerForm && registerSubmitButton) {
      registerSubmitButton.addEventListener('click', function () {
          registerForm.submit();
      });
  } else {
      console.error("登録フォームまたはボタンが見つかりません。");
  }

  // ログインフォームの送信処理
  let loginForm = document.getElementById('loginForm');
  let loginSubmitButton = document.getElementById('loginButton');

  if (loginForm && loginSubmitButton) {
      loginSubmitButton.addEventListener('click', function () {
          loginForm.submit();
      });
  } else {
      console.error("ログインフォームまたはボタンが見つかりません。");
  }
});
