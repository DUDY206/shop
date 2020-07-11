<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_sale_id');
            $table->unsignedBigInteger('user_created_id');
            $table->string('customer_name');
            $table->string('customer_phonenumber');
            $table->string('customer_address');
            $table->tinyInteger('status');
            $table->unsignedBigInteger('user_approved_id');
            $table->tinyInteger('approve_status');
            $table->dateTime('approved_at');
            $table->timestamps();
            $table->dateTime('finished_at');
            $table->integer('sale_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
