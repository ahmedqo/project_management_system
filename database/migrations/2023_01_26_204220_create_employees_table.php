<?php

use App\Functions\SystemFn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('zipcode');
            $table->date('birthDate');
            $table->string('identity')->unique();
            $table->string('identityType');
            $table->string('nationality');
            $table->string('password');
            $table->unsignedBigInteger('department');
            $table->unsignedBigInteger('designation');
            $table->unsignedBigInteger('insurance');
            $table->integer('status');
            $table->longText('photo')->nullable();
            $table->string('bg')->default(SystemFn::randomColor());
            $table->timestamps();

            $table->foreign('department')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('designation')->references('id')->on('designations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('insurance')->references('id')->on('insurances')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department', 'designation', 'insurance']);
        });

        Schema::dropIfExists('employees');
    }
}
