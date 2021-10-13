<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFrontCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->text('coupon');
            $table->text('add_coupon');
            $table->text('delete_coupon');
            $table->text('expired_coupon');
            $table->tinyInteger('active_status')->default(1); 
            $table->integer('created_by')->nullable()->default(1)->unsigned();  
            $table->integer('updated_by')->nullable()->default(1)->unsigned(); 
            $table->timestamps();
        });

        DB::table('front_coupons')->insert(
            [
                'coupon'=>'We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.',
                'add_coupon'   =>'We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.',
                'delete_coupon' =>'We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.',
                'expired_coupon' =>'We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.',
            ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_coupons');
    }
}
