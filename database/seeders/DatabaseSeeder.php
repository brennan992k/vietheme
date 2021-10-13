<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(VendorSeeder::class);
         $this->call(ItemSeeder::class);
         $this->call(CustomerSeeder::class);
        //  $this->call(LabelSeeder::class);
         $this->call(BadgeSeeder::class);
         $this->call(CouponSeeder::class);
         $this->call(PackageSeeder::class);
         $this->call(TaxSeeder::class);
        //  $this->call(ItemFeeSeeder::class);
         $this->call(PaymentMethodSeeder::class);
         $this->call(AgentSeeder::class);
         $this->call(TicketSeeder::class);
        //  $this->call(SubAttributeTableSeeder::class);
         
         
    }
}