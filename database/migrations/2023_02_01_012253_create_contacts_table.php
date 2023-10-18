<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client');
            $table->string("title");
            $table->string("firstName");
            $table->string("lastName");
            $table->string("email");
            $table->string("phone");
            $table->string("function");
            $table->timestamps();

            $table->foreign('client')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['client']);
        });
        Schema::dropIfExists('contacts');
    }
}
