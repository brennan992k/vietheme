<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('refund_comment_10');
            $table->foreign('user_id', 'refund_comment_10')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('author_id')->nullable()->unsigned()->index('refund_comment_20');
            $table->foreign('author_id', 'refund_comment_20')->references('id')->on('users')->onUpdate('RESTRICT');

            $table->integer('item_id')->unsigned()->index('refund_comment_30');
            $table->foreign('item_id', 'refund_comment_30')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->longText('refund_comment');
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
        Schema::dropIfExists('refund_comments');
    }
}
