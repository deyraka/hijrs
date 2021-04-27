<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHistoryMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_history_maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('no_ticket', 8)->nullable();
            $table->foreign('no_ticket')->references('no_ticket')->on('tbl_complaint')->onUpdate('cascade')->onDelete('no action');
            $table->uuid('id_bmn')->nullable();
            $table->foreign('id_bmn')->references('id')->on('mstr_bmn')->onUpdate('cascade')->onDelete('cascade');
            $table->text('catatan_maintenance');
            $table->char('handled_by', 9)->nullable();
            $table->foreign('handled_by')->references('id')->on('tbl_user')->onUpdate('cascade')->onDelete('no action');
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
        Schema::dropIfExists('tbl_history_maintenance');
    }
}
