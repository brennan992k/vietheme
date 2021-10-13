<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned()->index('coupon_fk0');
            $table->foreign('vendor_id', 'coupon_fk0')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT'); 
			$table->string('min_price')->nullable();
			$table->string('coupon_code')->nullable();
			$table->boolean('coupon_type')->nullable();
            $table->boolean('discount_type')->nullable();
			$table->float('discount', 10, 0)->nullable(); 
            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
