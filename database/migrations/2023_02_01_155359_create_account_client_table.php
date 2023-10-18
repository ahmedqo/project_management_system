<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_client', function (Blueprint $table) {
            $table->unsignedBigInteger('client');
            $table->unsignedBigInteger('account');

            $table->foreign('client')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');;
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
        Schema::table('account_client', function (Blueprint $table) {
            $table->dropForeign(['client', 'account']);
        });
        Schema::dropIfExists('account_client');
    }
}
