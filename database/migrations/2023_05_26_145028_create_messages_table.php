<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation');
            $table->unsignedBigInteger('employee');
            $table->longText('content');
            $table->integer('isRead')->default(0);
            $table->timestamps();

            $table->foreign('conversation')->references('id')->on('conversations')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('employee')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');;
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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['conversation', 'employee']);
        });
        Schema::dropIfExists('messages');
    }
}
