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
        Schema::create('dept_proc_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_procurement_id');
            $table->foreign('department_procurement_id')->references('id')->on('department_procurements');
            $table->text('comment');
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
        Schema::dropIfExists('dept_proc_comments');
    }
};
