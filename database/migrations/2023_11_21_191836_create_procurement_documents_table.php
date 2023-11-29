<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_procurement_id');
            $table->foreign('department_procurement_id')->references('id')->on('department_procurements');
            $table->string('title');
            $table->string('file');
            $table->unsignedBigInteger('procurement_id');
            $table->foreign('procurement_id')->references('id')->on('procurements');
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
        Schema::dropIfExists('procurement_documents');
    }
};
