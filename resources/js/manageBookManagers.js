document.addEventListener('DOMContentLoaded', function() {
  // 「編集」ボタンのイベントハンドラ
  document.querySelectorAll('.edit-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      let managerId = this.dataset.managerId;
      let managerName = this.dataset.managerName;
      let managerBookAdminId = this.dataset.managerBookAdminId;

      // 編集用フォームの隠しフィールドに値を設定する
      document.getElementById('action').value = 'edit';
      document.getElementById('manager_id').value = managerId;
      document.getElementById('name').value = managerName;
      document.getElementById('bookAdminID').value = managerBookAdminId;
      document.getElementById('actionSelect').value = 'edit';

      // ページを上にスクロールしてフォームへ
      window.scrollTo({ top: 250, behavior: 'smooth' });
    });
  });

  // 「削除」ボタンのイベントハンドラ
  document.querySelectorAll('.delete-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      let managerId = this.dataset.managerId;

      // 確認ダイアログボックスを表示する
      if (confirm('本当に書籍管理者を削除しますか？')) {
        // 書籍管理者を削除するためにAJAXリクエストを送信します
        fetch('/adminDashboard/bookManagers/delete/' + managerId, {
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
            console.error('書籍管理者削除エラー :', response.statusText);
          }
        })
        .catch(error => {
          console.error('ネットワークエラー :', error);
        });
      }
    });
  });
});
