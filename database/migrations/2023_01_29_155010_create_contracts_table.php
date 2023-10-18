<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee');
            $table->string('type');
            $table->float('salary');
            $table->string('compensation');
            $table->integer('probation');
            $table->date('startDate');
            $table->date('endDate');
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
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['employee']);
        });

        Schema::dropIfExists('contracts');
    }
}
