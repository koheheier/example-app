<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tweets', function (Blueprint $table) {
            // unsignedBigInteger...マイナスを含まない、18京～の数字。unsignedがなかった場合、マイナスを含んだ-9京～9京になる
            // after...カラムの順番指定。下述なら、idの後に追加されるということになる。デフォルトなら最後尾に追加されることになる？不明。多分そうなる
            $table->unsignedBigInteger('user_id')->after('id');

            // usersテーブルのidカラムにuser_idカラムを関連づける。つまり、userテーブルの外部キーを設定
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->dropForeign('tweets_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
