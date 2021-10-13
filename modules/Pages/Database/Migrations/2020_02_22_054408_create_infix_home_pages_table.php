<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfixHomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_home_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('homepage_title');
            $table->text('homepage_description');
            $table->string('feature_title');
            $table->text('feature_title_description');
            $table->string('product_title');
            $table->string('banner_image')->nullable();
            $table->text('product_title_description');
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        DB::table('infix_home_pages')->insert(
            [
                'homepage_title'       => 'Thousands of Products are waiting!',
                'homepage_description' => 'crafty is an element gallery for web designers and web developers, anybody using Bootstrap
                                        will find this website essential in their craft.',
                'feature_title'   => 'Featured Items of the week',
                'feature_title_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'product_title' => 'Discover Our Latest Digital Goods',
                'product_title_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'banner_image' => url('public/frontend/img/banner/banner-img-1.png'),

            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_home_pages');
    }
}
