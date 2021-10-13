<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Entities\InfixBlogCategory;
use Illuminate\Database\Migrations\Migration;
use Faker\Factory as Faker;

class CreateInfixBlogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_blog_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        $faker = Faker::create();
        for ($i = 1; $i <= 10; $i++) {
            $store = new InfixBlogCategory();
            $store->name = $faker->company;
            $store->status = 1;
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
        Schema::dropIfExists('infix_blog_category');
    }
}
