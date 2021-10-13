<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundSubscriptionsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('refund_subscriptions', function (Blueprint $table) {
			$table->increments('id', true);
			$table->integer('user_id')->unsigned()->index('refund_subscriptions_fk0');
			$table->integer('subscription_plan_id')->unsigned()->index('refund_subscriptions_fk1');
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
		Schema::drop('refund_subscriptions');
	}
}
