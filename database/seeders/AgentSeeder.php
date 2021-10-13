<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
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
            $user = new User();
            $user->role_id = 2;
            $user->email = $faker->email;
            $user->password  = Hash::make(12345678);
            $user->username = $faker->firstName;
            $user->email_verified_at = Carbon::now();
            $user->status = 1;
            $user->access_status = 1;
            $user->save();
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $faker->firstName;
            $profile->last_name = $faker->firstName;
            $profile->mobile = '123456789';
            $profile->save();

            $user->full_name = $profile->first_name . ' ' . $profile->last_name;
            $user->save();
        }
    }
}
