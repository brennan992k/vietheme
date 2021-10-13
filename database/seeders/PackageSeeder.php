<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PackageType;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package_type = PackageType::where('status', 1)->get();
        $faker = Faker::create();
        $i = 0;
        foreach ($package_type as $key => $value) {
            $data = new Package();
            $data->package_type = $value->id;
            $data->description = $faker->text;
            $data->total_item = $i + 50;
            $data->image = 'public/uploads/package/' . 'package-0.png';
            $data->save();
            $i + 50;
        }
    }
}
