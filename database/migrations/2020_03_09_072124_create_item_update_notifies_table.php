<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemUpdateNotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_update_notifies', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('notify')->default(0);
            $table->integer('user_id')->unsigned()->index('item_update_notifies_00');
            $table->foreign('user_id', 'item_update_notifies_00')->references('id')->on('users')->onDelete('cascade');
            $table->integer('item_id')->unsigned()->index('item_update_notifies_99');
            $table->foreign('item_id', 'item_update_notifies_99')->references('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('item_update_notifies');
    }
}
