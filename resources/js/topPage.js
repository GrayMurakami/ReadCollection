// モーダルウィンドウを開くリンクを取得
const modalLinks = {
  loginLink: document.getElementById('loginLink'),
  registerLink: document.getElementById('registerLink'),
  resetPasswordLink: document.getElementById('resetPasswordLink')
};

// リンクにクリック・イベント・ハンドラを追加
function addModalEventListeners() {
  for (const [linkId, link] of Object.entries(modalLinks)) {
      if (link) {
          link.addEventListener('click', function (e) {
              e.preventDefault(); // デフォルトのリンク動作を上書き
              const formId = linkId.replace('Link', 'Form');
              clearForm(formId);
              switchModal(linkId.replace('Link', 'Modal'));
          });
      }
  }
}

// フォーム・フィールドの値をリセットする関数
function clearForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.reset(); // フォームの値をリセット
    }
}

// モーダルウィンドウを切り替える関数
function switchModal(showModalId) {
  Object.values(modalLinks).forEach(link => {
      const modalId = link.id.replace('Link', 'Modal');
      const modal = document.getElementById(modalId);
      if (modal) {
          modal.style.display = (modalId === showModalId) ? 'block' : 'none';
      }
  });
}

// チェックボックスイベントハンドラ
document.getElementById('agreeTerms').addEventListener('change', function () {
  const registerButton = document.getElementById('registerButton');
  if (registerButton) {
      registerButton.disabled = !this.checked;
  }
});

// パスワード表示切替関数
function togglePasswordVisibility(toggleId, passwordFieldId, iconId) {
  document.getElementById(toggleId).addEventListener('click', function () {
      const passwordField = document.getElementById(passwordFieldId);
      const toggleIcon = document.getElementById(iconId);
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);

      toggleIcon.classList.toggle('bi-eye', type === 'password');
      toggleIcon.classList.toggle('bi-eye-slash', type !== 'password');
  });
}

// パスワード表示切替をすべてのフィールドに適用
const togglePasswordConfigs = [
  { toggleId: 'togglePasswordRegister', passwordFieldId: 'passwordRegister', iconId: 'toggleIconRegister' },
  { toggleId: 'togglePasswordRegister2', passwordFieldId: 'password_confirmation', iconId: 'toggleIconRegister2' },
  { toggleId: 'togglePasswordLogin', passwordFieldId: 'passwordLogin', iconId: 'toggleIconLogin' },
  { toggleId: 'toggleAdminPassword', passwordFieldId: 'adminPassword', iconId: 'toggleIconAdmin' },
  { toggleId: 'toggleBookAdminPassword', passwordFieldId: 'bookAdminPassword', iconId: 'toggleIconBookAdmin' }
];

togglePasswordConfigs.forEach(config => togglePasswordVisibility(config.toggleId, config.passwordFieldId, config.iconId));

// イベントリスナーを追加
addModalEventListeners();