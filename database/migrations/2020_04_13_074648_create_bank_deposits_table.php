<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_deposits', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('owner_name');
            $table->string('account_number');
            $table->double('amount', 2);
            $table->integer('status')->default(0)->nullable();
            $table->integer('depositor_id')->nullable()->unsigned()->index('bank_deposit_01');
            $table->foreign('depositor_id', 'bank_deposit_01')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('bank_deposits');
    }
}
