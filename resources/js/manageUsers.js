document.addEventListener('DOMContentLoaded', function() {
  // 編集」ボタンのイベントハンドラ
  document.querySelectorAll('.edit-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      let userId = this.dataset.userId;
      let userName = this.dataset.userName;
      let userEmail = this.dataset.userEmail;

      // 編集用フォームの隠しフィールドに値を設定する
      document.getElementById('action').value = 'edit';
      document.getElementById('user_id').value = userId;
      document.getElementById('name').value = userName;
      document.getElementById('email').value = userEmail;
      document.getElementById('actionSelect').value = 'edit';

      // ページを上にスクロールしてフォームへ
      window.scrollTo({ top: 250, behavior: 'smooth' });
    });
  });

  // 削除」ボタンのイベントハンドラ
  document.querySelectorAll('.delete-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      let userId = this.dataset.userId;
      // let userName = this.dataset.userName;

      // 確認ダイアログボックスを表示する
      if (confirm('本当にユーザーを削除しますか？')) {
        // ユーザーを削除するためにAJAXリクエストを送信します
        fetch('/adminDashboard/users/delete/' + userId, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => {
          if (response.ok) {
            // 削除に成功したら、ページを更新してください
            location.reload();
          } else {
            console.error('ユーザー削除エラー :', response.statusText);
          }
        })
        .catch(error => {
          console.error('ネットワークエラー :', error);
        });
      }
    });
  });
});
