<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            /*カラム名:id, 型:bigint unsigned, PRIMARY KEY:〇 */
            $table->bigIncrements('id');
            /*カラム名:name, 型:varchar(255), NOT NULL:〇 */
            $table->string('name', 255)->nullable(false);
            /*カラム名:email, 型:varchar(255), NOT NULL:〇 */
            $table->string('email', 255)->nullable(false);
            /*カラム名:password, 型:varchar(255), NOT NULL:〇 */
            $table->string('password', 255)->nullable(false);
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
        Schema::dropIfExists('users');
    }
}
