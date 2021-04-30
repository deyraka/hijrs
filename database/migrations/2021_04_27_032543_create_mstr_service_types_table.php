<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstrServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mstr_service_type', function (Blueprint $table) {
            $table->id();
            $table->char('jenis', 1)->comment('1=maintenance, 2=Permintaan, 3=Gangguan');
            $table->string('judul', 50);
            $table->text('deskripsi')->nullable();
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
        Schema::dropIfExists('mstr_service_type');
        Schema::table('mstr_service_type', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
