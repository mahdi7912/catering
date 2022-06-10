<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('company_id')->unsigned()->nullable();
            $table->enum('type', ['admin', 'company', 'user'])->default('user');
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('phone')->unique()->nullable();
            $table->float('credit')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
