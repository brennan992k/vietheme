<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('feedback_001');
            $table->foreign('user_id','feedback_001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('feedback_by')->unsigned()->index('feedback_07');
            $table->foreign('feedback_by','feedback_07')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('item_id')->unsigned()->index('feedback_0044');
            $table->foreign('item_id','feedback_0044')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->longText('feedback')->nullable();
            $table->longText('subject')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('feedback');
    }
}
