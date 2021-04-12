<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteFlagColumnsToTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->tinyInteger('delete_flag')->after('statut_id')->default(0)->comment('削除フラグ 1:削除');
        });

        \App\Models\Task::all()->each(function(\App\Models\Task $task){
            $task->delete_flag = 0;
            $task->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('delete_flag');
        });
    }
}
