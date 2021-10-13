<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default(1);
            $table->integer('user_id')->unsigned()->index('item_payments_001');
            $table->foreign('user_id','item_payments_001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('type')->nullable();
            $table->string('token')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('charge_id')->nullable();
            $table->string('stripe_id')->nullable(); 
            $table->integer('item_id')->unsigned()->index('item_payments_0002');
            $table->foreign('item_id','item_payments_0002')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->float('amount',10,2);
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
        Schema::dropIfExists('item_payments');
    }
}
