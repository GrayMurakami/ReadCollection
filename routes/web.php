<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Manager\BookManagerDashboardController;
use App\Http\Controllers\Manager\BookManagerLoginController;
use App\Http\Controllers\Manager\BookStatisticsController;
use App\Http\Controllers\Manager\BookStatisticsGraphsController;

use App\Http\Controllers\BookController;

use App\Http\Controllers\ContactController;


// ログインページと管理画面のルート
Route::get('/adminLogin', [AdminLoginController::class, 'showLoginForm'])->name('adminLoginForm');
Route::post('/adminLogin', [AdminLoginController::class, 'login'])->name('adminLogin');


// 管理パネルのホームページ
Route::get('/adminDashboard', [AdminDashboardController::class, 'index'])->name('adminDashboard');
Route::get('/adminDashboard', [AdminLoginController::class, 'showDashboard'])->name('adminDashboard');

// ユーザーを管理するためのルーチン
Route::get('/adminDashboard/users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
Route::post('/adminDashboard/users/process', [AdminController::class, 'processUserAction'])->name('admin.process');
Route::delete('/adminDashboard/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

// ブックマネージャーを管理するためのルーチン
Route::get('/adminDashboard/bookManagers', [AdminController::class, 'manageBookManagers'])->name('admin.manageBookManagers');
Route::post('/adminDashboard/bookManagers/process', [AdminController::class, 'processBookManagerAction'])->name('admin.processBookManagerAction');
Route::delete('/adminDashboard/bookManagers/delete/{id}', [AdminController::class, 'deleteBookManager'])->name('admin.deleteBookManager');

// 監査ログを管理するためのルーチン
Route::get('/adminDashboard/audit-logs', [AdminController::class, 'manageAuditLogs'])->name('admin.manageAuditLogs');


// ログインページと書籍管理画面のルート
Route::get('/bookAdminLogin', [BookManagerLoginController::class, 'showLoginForm'])->name('bookAdminLoginForm');
Route::post('/bookAdminLogin', [BookManagerLoginController::class, 'login'])->name('bookAdminLogin');


// 書籍管理者パネルのホームページ
Route::get('/bookManagerDashboard', [BookManagerDashboardController::class, 'bookManager'])->name('bookManagerDashboard');
Route::get('/bookManagerDashboard', [BookManagerDashboardController::class, 'index'])->name('bookManagerDashboard');
Route::get('/bookManagerDashboard/contact', [BookManagerDashboardController::class, 'contactWithAdmin'])->name('contactWithAdmin');

// 書籍の管理
Route::get('/bookManagerDashboard/bookManagePage', [BookController::class, 'manageBooks'])->name('books.manage');

Route::post('/bookManagerDashboard/addBook', [BookController::class, 'addBook'])->name('books.add');
Route::put('/bookManagerDashboard/editBook/{book_id}', [BookController::class, 'editBookSubmit'])->name('books.edit.submit');
Route::delete('/bookManagerDashboard/deleteBook/{book_id}', [BookController::class, 'deleteBook'])->name('books.delete');

Route::get('bookManagerDashboard/statistics', [BookStatisticsController::class, 'index'])->name('statistics');
Route::get('bookManagerDashboard/statisticsGraphs', [BookStatisticsGraphsController::class, 'index'])->name('statisticsGraphs');


// フォームを表示し、登録およびログインデータを処理するためのルート
Route::get('/userRegister', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/userRegister', [RegisterController::class, 'register']);

Route::get('/userLoginN', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/userLoginN', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 再設定パスワードのルート
Route::post('/resetPassword', 'App\Http\Controllers\Auth\ResetPasswordController@sendResetLink')->name('password.reset');


// TOP画面と利用者画面のルート
Route::get('/', [PageController::class, 'topPage'])->name('topPage');

// ホームページと以降のページを保護
Route::middleware(['auth.check'])->group(function () {
  Route::get('/home', [PageController::class, 'homePage'])->name('homePage');

  Route::get('/best10', [PageController::class, 'best10Page'])->name('best10Page');
  Route::get('/mustRead', [PageController::class, 'mustReadPage'])->name('mustReadPage');
  Route::get('/bestseller', [PageController::class, 'bestsellerPage'])->name('bestsellerPage');

  // 検索ページ
  Route::get('/simpleSearch', [PageController::class, 'showSimpleSearchPage'])->name('simpleSearchPage');
  Route::post('/simpleSearch', [BookController::class, 'simpleSearchPage']);

  Route::get('/detailSearch', [PageController::class, 'showDetailSearchPage'])->name('detailSearchPage');
  Route::post('/detailSearch', [BookController::class, 'detailSearchPage']);

  //　管理者と問い合わせのルート
  Route::get('/contact', [PageController::class, 'contactPage'])->name('contactPage');
  Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


  // 各書籍のページのルート
  Route::get('/books/book1', [BookController::class, 'showBook1'])->name('books.showBook1');
  Route::get('/books/book2', [BookController::class, 'showBook2'])->name('books.showBook2');
  Route::get('/books/book3', [BookController::class, 'showBook3'])->name('books.showBook3');
  Route::get('/books/book4', [BookController::class, 'showBook4'])->name('books.showBook4');
  Route::get('/books/book5', [BookController::class, 'showBook5'])->name('books.showBook5');
  Route::get('/books/book6', [BookController::class, 'showBook6'])->name('books.showBook6');
  Route::get('/books/book7', [BookController::class, 'showBook7'])->name('books.showBook7');
  Route::get('/books/book8', [BookController::class, 'showBook8'])->name('books.showBook8');
  Route::get('/books/book9', [BookController::class, 'showBook9'])->name('books.showBook9');
  Route::get('/books/book10', [BookController::class, 'showBook10'])->name('books.showBook10');
  Route::get('/books/book11', [BookController::class, 'showBook11'])->name('books.showBook11');
  Route::get('/books/book12', [BookController::class, 'showBook12'])->name('books.showBook12');
  Route::get('/books/book13', [BookController::class, 'showBook13'])->name('books.showBook13');
  Route::get('/books/book14', [BookController::class, 'showBook14'])->name('books.showBook14');
  Route::get('/books/book15', [BookController::class, 'showBook15'])->name('books.showBook15');
  Route::get('/books/book16', [BookController::class, 'showBook16'])->name('books.showBook16');
  Route::get('/books/book17', [BookController::class, 'showBook17'])->name('books.showBook17');
  Route::get('/books/book18', [BookController::class, 'showBook18'])->name('books.showBook18');
  Route::get('/books/book19', [BookController::class, 'showBook19'])->name('books.showBook19');
  Route::get('/books/book20', [BookController::class, 'showBook20'])->name('books.showBook20');
  Route::get('/books/book21', [BookController::class, 'showBook21'])->name('books.showBook21');
  Route::get('/books/book22', [BookController::class, 'showBook22'])->name('books.showBook22');
  Route::get('/books/book23', [BookController::class, 'showBook23'])->name('books.showBook23');
  Route::get('/books/book24', [BookController::class, 'showBook24'])->name('books.showBook24');
  Route::get('/books/book25', [BookController::class, 'showBook25'])->name('books.showBook25');
  Route::get('/books/book26', [BookController::class, 'showBook26'])->name('books.showBook26');
  Route::get('/books/book27', [BookController::class, 'showBook27'])->name('books.showBook27');
  Route::get('/books/book28', [BookController::class, 'showBook28'])->name('books.showBook28');
  Route::get('/books/book29', [BookController::class, 'showBook29'])->name('books.showBook29');
  Route::get('/books/book30', [BookController::class, 'showBook30'])->name('books.showBook30');
  Route::get('/books/book31', [BookController::class, 'showBook31'])->name('books.showBook31');
  Route::get('/books/book32', [BookController::class, 'showBook32'])->name('books.showBook32');
  Route::get('/books/book33', [BookController::class, 'showBook33'])->name('books.showBook33');
  Route::get('/books/book34', [BookController::class, 'showBook34'])->name('books.showBook34');
  Route::get('/books/book35', [BookController::class, 'showBook35'])->name('books.showBook35');
  Route::get('/books/book36', [BookController::class, 'showBook36'])->name('books.showBook36');
  Route::get('/books/book37', [BookController::class, 'showBook37'])->name('books.showBook37');
  Route::get('/books/book38', [BookController::class, 'showBook38'])->name('books.showBook38');
  Route::get('/books/book39', [BookController::class, 'showBook39'])->name('books.showBook39');
  Route::get('/books/book40', [BookController::class, 'showBook40'])->name('books.showBook40');
  Route::get('/books/book41', [BookController::class, 'showBook41'])->name('books.showBook41');
  Route::get('/books/book42', [BookController::class, 'showBook42'])->name('books.showBook42');
  Route::get('/books/book43', [BookController::class, 'showBook43'])->name('books.showBook43');
  Route::get('/books/book44', [BookController::class, 'showBook44'])->name('books.showBook44');
  Route::get('/books/book45', [BookController::class, 'showBook45'])->name('books.showBook45');
  Route::get('/books/book46', [BookController::class, 'showBook46'])->name('books.showBook46');
  Route::get('/books/book47', [BookController::class, 'showBook47'])->name('books.showBook47');
  Route::get('/books/book48', [BookController::class, 'showBook48'])->name('books.showBook48');
  Route::get('/books/book49', [BookController::class, 'showBook49'])->name('books.showBook49');
  Route::get('/books/book50', [BookController::class, 'showBook50'])->name('books.showBook50');
});
