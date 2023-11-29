<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ddo_code')->unique();
            $table->string('attached_department_code');
            $table->foreign('attached_department_code')->references('attached_department_code')->on('attached_departments');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('department_offices');
    }
}
