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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('開板帳號 PK');
            $table->string('name', 50)->comment('討論板名稱');
            $table->string('board_image', 50)->default('default.jpg')->comment('討論板進版圖');
            $table->string('description', 1024)->comment('討論板描述');
            $table->tinyInteger('show')->unsigned()->default(1)->comment('是否顯示');
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
        Schema::dropIfExists('boards');
    }
};
