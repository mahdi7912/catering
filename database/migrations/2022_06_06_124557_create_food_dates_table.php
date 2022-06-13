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
        Schema::create('food_dates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('food_id')->unsigned()->index();
            $table->enum('meal', ['breakfast', 'lunch', 'dinner']);
            $table->date('show_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_dates');
    }
};
