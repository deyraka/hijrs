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
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->char('id', 9);
            $table->primary('id');
            $table->string('username', 20);
            $table->string('password', 50);
            $table->string('nama', 50)->nullable(true);
            $table->char('satker', 5)->nullable(true);
            $table->foreign('satker')->references('id')->on('mstr_satker')->onUpdate('cascade')->onDelete('no action');
            $table->char('uker', 3)->nullable(true);
            $table->foreign('uker')->references('id')->on('mstr_uker')->onUpdate('cascade')->onDelete('no action');
            $table->string('email')->unique()->nullable(true);
            $table->string('no_hp', 12)->nullable(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user');
        Schema::table('tbl_user', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
