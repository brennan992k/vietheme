<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateItemFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable()->unsigned()->index('item_fees_007');
            $table->foreign('category_id', 'item_fees_007')->references('id')->on('item_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->float('re_fee', 10, 2);
            $table->float('ex_fee', 10, 2);
            $table->float('co_fee', 10, 2);
            $table->float('support_fee', 10, 2);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        $data = DB::table('item_categories')->get();
        $faker = Faker::create();
        $item_fees = [];
        foreach ($data as $key => $value) {
            $item_fees[] = [
                'category_id' => $value->id,
                're_fee' =>  $faker->numberBetween($min = 1, $max = 15),
                'ex_fee' => $faker->numberBetween($min = 30, $max = 80),
                'co_fee' => $faker->numberBetween($min = 20, $max = 30),
                'support_fee' => $faker->numberBetween($min = 1, $max = 10)
            ];
        }

        DB::table('item_fees')->insert($item_fees);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_fees');
    }
}
