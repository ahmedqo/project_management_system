<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('project');
            $table->unsignedBigInteger('employee');

            $table->foreign('project')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('employee')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the foreign key constraint
        Schema::table('project_employee', function (Blueprint $table) {
            $table->dropForeign(['project', 'employee']);
        });
        Schema::dropIfExists('project_employee');
    }
}
