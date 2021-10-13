<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorPayoutSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_payout_setups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->unsigned()->index('payout_user_id_01');
            $table->foreign('user_id', 'payout_user_id_01')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('payment_method_name');
            $table->string('payout_email');
            $table->string('payout_phone')->nullable();
            $table->integer('is_default')->default(0);
            $table->integer('active_status')->default(1);
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
        Schema::dropIfExists('author_payout_setups');
    }
}
