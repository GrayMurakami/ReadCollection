document.addEventListener('DOMContentLoaded', function () {
    let resetPasswordForm = document.getElementById('resetPasswordForm');
    resetPasswordForm.addEventListener('submit', async function (event) {
        event.preventDefault();
  
        let formData = new FormData(resetPasswordForm);
        try {
            let response = await fetch('/resetPassword', {
                method: 'POST',
                body: formData
            });

            if (response.redirected) {
                showSuccessMessage('パスワードリセットのメッセージが正常に送信されました。');
                window.location.href = response.url; // ユーザーをリダイレクト
            } else {
                let responseData = await response.json();
                if (response.ok) {
                    showSuccessMessage(responseData.message);
                } else {
                    showErrorMessage(responseData.message);
                }
            }
        } catch (error) {
            console.error('リクエストの実行中にエラーが発生しました:', error);
            showErrorMessage('リクエストの実行中にエラーが発生しました');
        }
    });
  
    function showSuccessMessage(message) {
        let successMessage = document.createElement('div');
        successMessage.classList.add('alert', 'alert-success');
        successMessage.innerText = message;
        resetPasswordForm.appendChild(successMessage);
  
        setTimeout(() => {
            successMessage.style.display = 'none';
            successMessage.remove();
        }, 5000);
    }
  
    function showErrorMessage(message) {
        let errorMessage = document.createElement('div');
        errorMessage.classList.add('alert', 'alert-danger');
        errorMessage.innerText = message;
        resetPasswordForm.appendChild(errorMessage);
  
        setTimeout(() => {
            errorMessage.style.display = 'none';
            errorMessage.remove();
        }, 5000);
    }
});
