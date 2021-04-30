<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstrBmnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mstr_bmn', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nup', 13)->nullable(true);
            $table->char('jenis', 1)->comment('1=PC, 2=laptop, 3=printer');
            $table->string('merk', 20);
            $table->string('type', 50);
            $table->char('thn_perolehan', 4);
            $table->char('lokasi_uker', 3)->nullable(true);
            $table->foreign('lokasi_uker')->references('id')->on('mstr_uker')->onUpdate('cascade')->onDelete('no action');
            $table->char('pemegang', 9)->nullable(true);
            $table->foreign('pemegang')->references('id')->on('tbl_user')->onUpdate('cascade')->onDelete('no action');
            $table->text('spek_asli')->nullable(true);
            $table->string('sn', 50)->nullable(true);
            $table->char('kondisi', 1);
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
        Schema::table('mstr_bmn', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('mstr_bmn');

    }
}
