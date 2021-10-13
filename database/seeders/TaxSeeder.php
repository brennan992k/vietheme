<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpnCountry;
use Modules\Tax\Entities\Tax;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax = SpnCountry::all();
        foreach ($tax as $key => $value) {
            $data = new Tax();
            $data->tax = 5;
            $data->country_id = $value->id;
            $data->save();
        }
    }
}
