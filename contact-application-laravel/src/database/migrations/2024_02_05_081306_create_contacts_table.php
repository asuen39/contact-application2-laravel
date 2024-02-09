<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            /*カラム名:id, 型:bigint unsigned, PRIMARY KEY:〇 */
            $table->bigIncrements('id');
            /*カラム名:category_id, 型:bigint unsigned, NOT NULL:〇, FOREIGN KEY:categories(id) */
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->foreign('category_id')->references('id')->on('categories');
            /*カラム名:first_name, 型:varchar(255), NOT NULL:〇 */
            $table->string('first_name', 255)->nullable(false);
            /*カラム名:last_name, 型:varchar(255), NOT NULL:〇 */
            $table->string('last_name', 255)->nullable(false);
            /*カラム名:gender, 型:tinyint, NOT NULL:〇, 補足:1:男性 2:女性 3:その他 */
            $table->tinyInteger('gender')->nullable(false)->comment('性別（1: 男性, 2: 女性, 3: その他）');
            /*カラム名:email, 型:varchar(255), NOT NULL:〇 */
            $table->string('email', 255)->nullable(false);
            /*カラム名:tell, 型:varchar(255), NOT NULL:〇 */
            $table->string('tell', 255)->nullable(false);
            /*カラム名:address, 型:varchar(255), NOT NULL:〇 */
            $table->string('address', 255)->nullable(false);
            /*カラム名:building, 型:varchar(255) */
            $table->string('building', 255)->nullable()->default(null);
            /*カラム名:detail, 型:text, NOT NULL:〇 */
            $table->text('detail')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
