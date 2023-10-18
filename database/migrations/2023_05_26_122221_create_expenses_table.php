<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee');
            $table->string('type');
            $table->date('date');
            $table->float('amount');
            $table->string('status');
            $table->longText('description')->nullable();
            $table->text('note')->nullable();
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
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['employee']);
        });
        Schema::dropIfExists('expenses');
    }
}
