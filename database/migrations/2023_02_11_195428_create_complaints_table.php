<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee');
            $table->string('grievance');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->string('status');
            $table->longText('description');
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
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['employee']);
        });
        Schema::dropIfExists('complaints');
    }
}
