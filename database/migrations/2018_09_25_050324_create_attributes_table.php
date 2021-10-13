<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('field_name');
            $table->boolean('status', 3)->default(1);
            $table->timestamps();
        });

        DB::table('attributes')->insert([
            [
                'name' => 'Compatible Browsers', // 1
                'field_name' => 'compatible_browsers',
            ],
            [
                'name' => 'Compatible With', // 2
                'field_name' => 'compatible_with',
            ],
            [
                'name' => 'Framework', // 3
                'field_name' => 'framework',
            ],
            [
                'name' => 'Software Version', // 4
                'field_name' => 'software_version',
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
        Schema::dropIfExists('attributes');
    }
}
