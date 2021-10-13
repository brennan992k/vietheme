<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_item_id')->unsigned()->index('refund_items_103');
            $table->foreign('order_item_id','refund_items_103')->references('id')->on('item_orders')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('user_id')->unsigned()->index('refund_items_10');
            $table->foreign('user_id','refund_items_10')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('author_id')->nullable()->unsigned()->index('refund_45');
            $table->foreign('author_id','refund_45')->references('id')->on('users')->onUpdate('RESTRICT');
            $table->integer('item_id')->unsigned()->index('refund_items_20');
            $table->foreign('item_id','refund_items_20')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->integer('ref_id')->nullable()->unsigned()->index('refund_items_30');
			$table->foreign('ref_id','refund_items_fk2')->references('id')->on('refund_reasons')->onUpdate('RESTRICT')->onDelete('RESTRICT')->unsigned()->index();
            $table->longText('refund_details');
            $table->boolean('author_status')->default(1);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('refunds');
    }
}
