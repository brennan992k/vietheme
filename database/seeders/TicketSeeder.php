<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Modules\Ticket\Entities\InfixTicket;
use Modules\Ticket\Entities\InfixTicketCategory;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $category = InfixTicketCategory::latest()->get();

        foreach ($category as $key => $value) {
           $ticket = new InfixTicket();
           $ticket->user_id = 6;
           $ticket->category_id = $key+1;
           $ticket->priority_id = 1;
           $ticket->department_id = 1;
           $ticket->subject = $faker->sentence;
           $ticket->description = $faker->sentence;
           $ticket->save();
        }
    }
}
