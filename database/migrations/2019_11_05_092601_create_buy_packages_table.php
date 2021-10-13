<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('package_buy');
            $table->foreign('user_id','package_buy')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('package_plan')->unsigned()->index('package_buy_plan');
            $table->foreign('package_plan','package_buy_plan')->references('id')->on('package_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->float('package_price',10,2);
            $table->float('total',10,2);
            $table->integer('totalItem')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('buy_packages');
    }
}
