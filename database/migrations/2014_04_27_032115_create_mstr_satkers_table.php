<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstrSatkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mstr_satker', function (Blueprint $table) {
            $table->char('id', 5);
            $table->primary('id');
            $table->string('deskripsi', 50);
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
        Schema::table('mstr_satker', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('mstr_satker');

    }
}
