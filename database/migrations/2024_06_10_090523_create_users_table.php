<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // 自動生成されるユーザーID。
            $table->string('name'); // ユーザーの名前のフィールド。
            $table->string('email')->unique(); // ユーザーのEメール・フィールド（一意な値）。
            $table->timestamp('email_verified_at')->nullable(); // メール認証のタイムスタンプ（nullでも可）。
            $table->string('password'); // ユーザーのパスワードをハッシュ化したもの。
            $table->rememberToken(); // 「remember me 」フィールド。
            $table->timestamps(); // レコードがいつ作成・更新されたかを追跡するフィールド。
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
