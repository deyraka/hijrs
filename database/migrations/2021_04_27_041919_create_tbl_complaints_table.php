<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_complaint', function (Blueprint $table) {
            $table->string('no_ticket', 8);
            $table->primary('no_ticket');
            $table->foreignId('id_service')->nullable()->constrained('mstr_service_type')->onUpdate('cascade')->onDelete('no action');
            $table->string('judul', 100);
            $table->text('catatan');
            $table->uuid('id_bmn')->nullable();
            $table->foreign('id_bmn')->references('id')->on('mstr_bmn')->onUpdate('cascade')->onDelete('cascade');
            $table->char('created_by', 9)->nullable();
            $table->foreign('created_by')->references('id')->on('tbl_user')->onUpdate('cascade')->onDelete('no action');
            $table->string('memo_file', 100);
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
        Schema::dropIfExists('tbl_complaint');
    }
}
