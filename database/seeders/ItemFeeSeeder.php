<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use App\Models\ItemFee;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ItemFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ItemCategory::where('up_permission', 1)->get();
        $faker = Faker::create();
        foreach ($data as $key => $value) {
            $item_fee = new ItemFee();
            $item_fee->category_id = $value->id;
            $item_fee->re_fee = $faker->numberBetween($min = 1, $max = 15);
            $item_fee->ex_fee = $faker->numberBetween($min = 30, $max = 80);
            $item_fee->support_fee = $faker->numberBetween($min = 1, $max = 10);
            $item_fee->save();
        }
    }
}
