<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->unsigned()->index('free_items_02');
            $table->foreign('item_id', 'free_items_02')->references('id')->on('items')->onDelete('cascade');
            $table->string('date')->nullable();
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
        Schema::dropIfExists('free_items');
    }
}
