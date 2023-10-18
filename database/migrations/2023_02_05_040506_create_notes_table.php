<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task');
            $table->unsignedBigInteger('employee');
            $table->longText('note');
            $table->timestamps();

            $table->foreign('task')->references('id')->on('tasks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['task', 'employee']);
        });
        Schema::dropIfExists('notes');
    }
}
