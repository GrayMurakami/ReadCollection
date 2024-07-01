// ログインフォームのデータをAJAXで送信するためのJavaScript -->

document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // 標準フォームの提出を防ぐ

        let formData = new FormData(this); // フォームデータを取得

        fetch('/login', { // エントリールートのリクエストを送信
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // サーバーの応答をコンソールに出力
            // 登録成功後の追加ロジック
            $('#loginModal').modal('hide'); // モーダルウィンドウを隠す
        })
        .catch(error => console.error('エラー:', error));
    });

