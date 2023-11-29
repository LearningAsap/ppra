<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_procurements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ddo_code');
            $table->foreign('ddo_code')->references('ddo_code')->on('department_offices');
            $table->unsignedBigInteger('procurement_id');
            $table->foreign('procurement_id')->references('id')->on('procurements');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('tender_notice');
            $table->string('tender_document');
            $table->date('opening_date');
            $table->date('closing_date');
            $table->inetger('status')->default(3);
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
        Schema::dropIfExists('department_procurements');
    }
}
