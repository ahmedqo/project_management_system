<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractPolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_policy', function (Blueprint $table) {
            $table->unsignedBigInteger('contract');
            $table->unsignedBigInteger('policy');

            $table->foreign('contract')->references('id')->on('contracts')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('policy')->references('id')->on('policies')->onUpdate('cascade')->onDelete('cascade');;
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
        Schema::table('contract_policy', function (Blueprint $table) {
            $table->dropForeign(['contract', 'policy']);
        });
        Schema::dropIfExists('contract_policy');
    }
}
