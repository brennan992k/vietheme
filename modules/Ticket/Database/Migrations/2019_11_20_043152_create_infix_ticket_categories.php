<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInfixTicketCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_ticket_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('active_status')->default(1);
            $table->timestamps();
        });
        DB::table('infix_ticket_categories')->insert([
            [
                'name' => 'Customer Service'
            ],
            [
                'name' => 'Buy Item'
            ],
            [
                'name' => 'Research and Development'
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
        Schema::dropIfExists('infix_ticket_categories');
    }
}
