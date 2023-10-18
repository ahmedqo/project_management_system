<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee');
            $table->string('reason');
            $table->date('date');
            $table->longText('description')->nullable();
            $table->timestamps();

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
        Schema::table('terminations', function (Blueprint $table) {
            $table->dropForeign(['employee']);
        });

        Schema::dropIfExists('terminations');
    }
}
