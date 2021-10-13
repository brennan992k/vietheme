<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerFeeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_fee_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('slug', 200);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('buyer_fee_types')->insert([

            [
                'slug' => 'extend_support_fee',
                'name' => 'Extend Support Fee',
            ],
            [
                'name' => 'Coupon Fee',
                'slug' => 'coupon_fee',
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyer_fee_types');
    }
}
