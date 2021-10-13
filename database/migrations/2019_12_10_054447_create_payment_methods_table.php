<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned()->index('payment_methods_001');
            $table->foreign('user_id', 'payment_methods_001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('card_id', 240)->nullable();
            $table->string('card_name', 200)->nullable();
            $table->string('name', 200)->nullable();
            $table->string('role', 10)->nullable();
            $table->string('card_number', 200)->nullable();
            $table->string('cvc', 200)->nullable();
            $table->string('exp_mm', 200)->nullable();
            $table->string('exp_yy', 200)->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('payment_methods');
    }
}
