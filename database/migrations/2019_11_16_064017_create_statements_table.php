<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->nullable()->unsigned()->index('Statement_011');
            $table->foreign('author_id', 'Statement_011')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('item_id')->unsigned()->index('statement_01');
            $table->foreign('item_id', 'statement_01')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('order_id')->nullable()->unsigned()->index('order_0011');
            $table->foreign('order_id', 'order_0011')->references('id')->on('orders')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('type');
            $table->string('title');
            $table->string('details');
            $table->float('price', 10, 2);
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
        Schema::dropIfExists('statements');
    }
}
