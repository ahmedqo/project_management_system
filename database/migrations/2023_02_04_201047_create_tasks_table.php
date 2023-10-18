<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project');
            $table->string('name');
            $table->string('priority');
            $table->date('dueDate');
            $table->float('duration');
            $table->string('status');
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->foreign('project')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project']);
        });
        Schema::dropIfExists('tasks');
    }
}
