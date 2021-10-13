<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount',8,2);
            $table->integer('user_id')->unsigned()->index('stripe_payment_001');
            $table->foreign('user_id','stripe_payment_001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('charge_id')->collation('utf8mb4_bin');
            $table->string('stripe_id')->comment('customer stripe id')->collation('utf8mb4_bin');            
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('stripe_payments');
    }
}
