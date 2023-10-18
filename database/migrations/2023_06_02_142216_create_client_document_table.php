<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_document', function (Blueprint $table) {
            $table->unsignedBigInteger('client');
            $table->unsignedBigInteger('document');

            $table->foreign('client')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('document')->references('id')->on('documents')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_document');
    }
}
