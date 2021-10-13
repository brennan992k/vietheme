<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_orders', function (Blueprint $table) {
            $table->increments ('id');
            $table->integer('order_id')->unsigned()->index('order_0001');
            $table->foreign('order_id', 'order_0001')->references('id')->on('orders')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('item_id')->unsigned()->index('order_item');
            $table->foreign('item_id', 'order_item')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->float('subtotal', 10, 2);
            $table->float('discount', 10, 2);
            $table->longText('item');
            $table->integer('country_id')->nullable();
            $table->integer('author_id')->nullable()->unsigned()->index('author_id_or');
            $table->foreign('author_id', 'author_id_or')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('user_id')->nullable()->unsigned()->index('order_user_item');
            $table->foreign('user_id', 'order_user_item')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->boolean('status')->default(1);
            $table->boolean('download_status')->nullable();
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
        Schema::dropIfExists('item_orders');
    }
}
