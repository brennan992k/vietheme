<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\KnowledgeBase\Entities\InfixKnowledgeBaseCategory;
use Faker\Factory as Faker;

class CreateInfixKnowledgeBaseCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_knowledge_base_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();
        });

        $faker = Faker::create();
        for ($i = 1; $i <= 5; $i++) {
            $store = new InfixKnowledgeBaseCategory();
            $store->name = $faker->company;
            $store->active_status = 1;
            $store->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_knowledge_base_category');
    }
}
