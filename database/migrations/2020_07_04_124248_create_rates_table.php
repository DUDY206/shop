<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            Schema::dropIfExists('rates');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rate_id');
            $table->string('rate_type');
            $table->tinyInteger('rate');
            $table->timestamps();

            $table->unique(['user_id','rate_id','rate_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
