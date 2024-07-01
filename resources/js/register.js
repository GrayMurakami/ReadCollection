// 登録フォームのデータをAJAXで送信するためのJavaScript 

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // 標準フォームの提出を防ぐ

    let formData = new FormData(this); // フォームデータを取得

    // metaタグからCSRFトークンを取得する
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/register', { // 登録ルートのリクエストを送信
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken // X-CSRF-TOKENヘッダーを設定する
        },
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {throw err});
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // サーバーの応答をコンソールに出力
        if (data.success) {
            $('#registerModal').modal('hide'); // モーダルウィンドウを隠す
        }
    })
    .catch(error => {
        console.error('エラー:', error);
        // ここでは、ユーザーにエラーを表示するコードを追加することができます
        if (error.errors) {
            for (const [key, messages] of Object.entries(error.errors)) {
                console.error(key, messages);
                // ユーザーにエラーを表示する
                let errorElement = document.getElementById(`${key}Error`);
                if (errorElement) {
                    errorElement.textContent = messages.join(', ');
                }
            }
        }
    });
});
