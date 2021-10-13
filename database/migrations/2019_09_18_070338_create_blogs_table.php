<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('user_id')->unsigned()->index('blogs_fk0');
            $table->integer('blog_category_id')->unsigned()->index('blogs_fk1');
            $table->string('title', 191);
            $table->text('description', 65535);
            $table->string('tags', 191);
            $table->boolean('status');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogs');
    }
}
