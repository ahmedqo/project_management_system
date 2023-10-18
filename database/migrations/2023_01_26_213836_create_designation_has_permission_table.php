<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationHasPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designation_has_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('designation');
            $table->unsignedBigInteger('permission');

            $table->foreign('designation')->references('id')->on('designations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permission')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('designation_has_permission', function (Blueprint $table) {
            $table->dropForeign(['designation', 'permission']);
        });

        Schema::dropIfExists('designation_has_permission');
    }
}
