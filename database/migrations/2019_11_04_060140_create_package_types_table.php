<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePackageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->float('month', 10, 2);
            $table->float('half_year', 10, 2);
            $table->float('year', 10, 2);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('package_types')->insert([
            [
                'name'      => 'Basic',
                'slug'      => 'basic',
                'month'     => 50,
                'half_year' => 260,
                'year'      => 500,
            ],
            [
                'name' => 'Medium',
                'slug' => 'medium',
                'month'     => 100,
                'half_year' => 500,
                'year'      => 900,
            ],
            [
                'name' => 'Premium',
                'slug' => 'premium',
                'month'     => 150,
                'half_year' => 700,
                'year'      => 1300,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'month'     => 250,
                'half_year' => 1200,
                'year'      => 2000,
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
        Schema::dropIfExists('package_types');
    }
}
