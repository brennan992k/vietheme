<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRefundReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });


        DB::table('refund_reasons')->insert([
            [
                'name' => 'It was a mistake purchase',
            ],
            [
                'name' => 'There was a problem with my payment',
            ],
            [
                'name' => 'I`m having a problem with item support',
            ],
            [
                'name' => 'The item has been removed from my downloads',
            ],
            [
                'name' => 'The item is broken , malfunctioning or not as described',
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
        Schema::dropIfExists('refund_reasons');
    }
}
