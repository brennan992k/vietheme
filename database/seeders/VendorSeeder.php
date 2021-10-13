<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Balance;
use App\Models\Profile;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 4; $i++) {
            $p = rand() % 100 * rand() % 100;
            $user = new User();
            $user->role_id = 4;
            $user->email = $faker->email;
            $user->password  = Hash::make(12345678);
            $user->full_name = $faker->name;
            $user->username = $faker->firstName;
            $user->email_verified_at = Carbon::now();
            $user->status = 1;
            $user->access_status = 1;
            $user->save();
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->country_id = 19;
            $profile->state_id = 290;
            $profile->city_id = 1374;
            $profile->save();
            $vendor = new Vendor();
            $vendor->user_id = $user->id;
            $vendor->save();
            $balance = new Balance();
            $balance->user_id = $user->id;
            $balance->type    = 1;
            $balance->amount  = 25 + $i;
            $balance->save();
        }
    }
}
