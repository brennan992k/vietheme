<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = User::where('role_id', 4)->get();
        foreach ($data as $key => $value) {
            $store = new PaymentMethod();
            $store->user_id = $value->id;
            $store->card_id = 'tok_1FsMadFZRivFOwo34sNnx9La';
            $store->card_number = '4242424242424242';
            $store->card_name = 'Visa';
            $store->name = 'Stripe';
            $store->status = 1;
            $store->role = 4;
            $store->cvc = '123';
            $store->exp_mm = 12;
            $store->exp_yy = 2022;
            $store->save();
        }
    }
}
