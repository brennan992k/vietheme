<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Modules\KnowledgeBase\Entities\InfixKnowledgeBase;
use Modules\KnowledgeBase\Entities\InfixKnBaseCategoryQuestion;

class CreateInfixCategoryQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_category_question', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('first_question');
            $table->integer('created_by');
            $table->timestamps();
        });
        for ($i = 1; $i <= 10; $i++) {
            $knowledge_base_category = DB::table('infix_knowledge_base_category')->where('active_status', 1)->get();
            foreach ($knowledge_base_category as $category) {
                $faker = Faker::create();
                $store = new InfixKnBaseCategoryQuestion();
                $store->category_id = $category->id;
                $store->first_question = $faker->sentence($nbWords = 6, $variableNbWords = true) . ' ?';
                $store->created_by = 1;
                $store->save();
            }
        }
        for ($i = 1; $i <= 10; $i++) {
            $knowledge_base_questions = DB::table('infix_category_question')->get();
            foreach ($knowledge_base_questions as $question) {
                $faker = Faker::create();
                $store = new InfixKnowledgeBase();
                $store->question_id = $question->id;
                $store->sub_question = $faker->sentence($nbWords = 6, $variableNbWords = true) . ' ?';
                $store->answer = $faker->text;
                $store->answered_by = 1;
                $store->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_category_question');
    }
}
