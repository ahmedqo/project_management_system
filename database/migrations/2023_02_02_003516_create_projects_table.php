<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client');
            $table->unsignedBigInteger('manager');
            $table->string('name');
            $table->date('dueDate');
            $table->float('budget');
            $table->string('status');
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->foreign('client')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('manager')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['client', 'manager']);
        });
        Schema::dropIfExists('projects');
    }
}
