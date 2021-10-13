<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateReviewTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('review_types')->insert([
            [
                'name' => 'Feature Availability',
            ],
            [
                'name' => 'Documentation Quality',
            ],
            [
                'name' => 'Felxibility',
            ],
            [
                'name' => 'Customer Support Bugs',
            ],
            [
                'name' => 'Code Quality',
            ],
            [
                'name' => 'Design Quality',
            ],
            [
                'name' => 'Customizability',
            ],
            [
                'name' => 'Others',
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_types');
    }
}
