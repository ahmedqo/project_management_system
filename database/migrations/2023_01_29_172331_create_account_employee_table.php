<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('employee');
            $table->unsignedBigInteger('account');

            $table->foreign('employee')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('account_employee', function (Blueprint $table) {
            $table->dropForeign(['employee', 'account']);
        });
        Schema::dropIfExists('account_employee');
    }
}
