<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
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
// items テーブルと外部キーの存在を確認して削除
    if (Schema::hasTable('items')) {
        Schema::table('items', function (Blueprint $table) {
            // 外部キーが存在する場合にのみ削除
            $table->dropForeign(['condition_id']);
        });
    }

    // conditions テーブルの削除
    Schema::dropIfExists('conditions');
}
}
