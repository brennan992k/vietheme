<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned()->index('support01');
            $table->foreign('user_id', 'support01')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('item_id')->nullable()->unsigned()->index('support02');
            $table->foreign('item_id', 'support02')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('vendor_id')->nullable()->unsigned()->index('support03');
            $table->foreign('vendor_id', 'support03')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->longText('message');
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
        Schema::dropIfExists('supports');
    }
}
