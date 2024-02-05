<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            /*カラム名:id, 型:bigint unsigned, PRIMARY KEY:〇 */
            $table->bigIncrements('id');
            /*カラム名:content, 型:varchar(255), NOT NULL:〇 */
            $table->string('content', 255)->nullable(false);
            /*カラム名:created_at, 型:timestamp */
            $table->timestamp('created_at')->useCurrent()->nullable();
            /*カラム名:updated_at, 型:timestamp */
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
