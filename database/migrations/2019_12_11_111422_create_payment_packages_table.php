<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('payment_packages_001');
            $table->foreign('user_id','payment_packages_001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('charge_id')->nullable();
            $table->string('stripe_id')->nullable(); 
            $table->integer('package_plan')->unsigned()->index('payment_packages_003');
            $table->foreign('package_plan','payment_packages_003')->references('id')->on('package_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('payment_packages');
    }
}
