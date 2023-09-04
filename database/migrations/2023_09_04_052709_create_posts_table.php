<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('board_id')->unsigned()->comment('討論板 PK');
            $table->bigInteger('post_user_id')->unsigned()->comment('張貼文章帳號 PK');
            $table->bigInteger('category_id')->unsigned()->comment('分類 PK');
            $table->string('title', 100)->comment('文章標題');
            $table->string('content', 1024)->comment('文章內容');
            $table->tinyInteger('status')->unsigned()->default(1)->comment('文章狀態');
            $table->dateTime('created_at')->nullable()->comment('建立時間');
            $table->dateTime('updated_at')->nullable()->comment('最後更新時間');
            $table->dateTime('deleted_at')->nullable()->comment('刪除時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
