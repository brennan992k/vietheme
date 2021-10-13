<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInfixDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });

        DB::table('infix_departments')->insert([
            ['name' => 'Production'],
            ['name' => 'Purchasing'],
            ['name' => 'Marketing'],
            ['name' => 'Customer Service'],
            ['name' => 'Support'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_departments');
    }
}
