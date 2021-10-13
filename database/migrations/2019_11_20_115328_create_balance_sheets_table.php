<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned()->index('balance_sheets_01');
            $table->foreign('user_id', 'balance_sheets_01')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('author_id')->nullable()->unsigned()->index('balance_sheets_02');
            $table->foreign('author_id', 'balance_sheets_02')->references('id')->on('users')->onUpdate('RESTRICT');
            $table->integer('item_id')->nullable()->unsigned()->index('balance_sheets_o3');
            $table->foreign('item_id', 'balance_sheets_o3')->references('id')->on('items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('order_id')->nullable()->unsigned()->index('balance_sheets_o4');
            $table->foreign('order_id', 'balance_sheets_o4')->references('id')->on('orders')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->float('price', 10, 2)->nullable();
            $table->float('tax', 10, 2)->nullable();
            $table->float('discount', 10, 2)->nullable();
            $table->float('fee', 10, 2)->nullable();
            $table->float('service', 10, 2)->nullable();
            $table->float('income', 10, 2)->nullable();
            $table->float('expense', 10, 2)->nullable();
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
        Schema::dropIfExists('balance_sheets');
    }
}
