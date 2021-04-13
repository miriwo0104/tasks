<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('ユーザーid');
            $table->string('name')->comment('メモ名');
            $table->text('detail')->nullable()->comment('メモ詳細');
            $table->unsignedInteger('workspace_id')->comment('ワークスペースid');
            $table->unsignedTinyInteger('delete_flag')->default(0)->comment('削除フラグ 1:削除');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memos');
    }
}
