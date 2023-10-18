<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('task');
            $table->unsignedBigInteger('employee');

            $table->foreign('task')->references('id')->on('tasks')->onUpdate('cascade')->onDelete('cascade');;
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
        Schema::table('task_employee', function (Blueprint $table) {
            $table->dropForeign(['task', 'employee']);
        });
        Schema::dropIfExists('task_employee');
    }
}
