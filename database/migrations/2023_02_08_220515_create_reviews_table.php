<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee');
            $table->date('date');
            $table->string('work');
            $table->string('productivity');
            $table->string('communication');
            $table->string('collaboration');
            $table->string('punctuality');
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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['employee']);
        });
        Schema::dropIfExists('reviews');
    }
}
