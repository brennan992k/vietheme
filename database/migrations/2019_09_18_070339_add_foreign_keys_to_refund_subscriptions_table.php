<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRefundSubscriptionsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('refund_subscriptions', function (Blueprint $table) {
			$table->foreign('user_id', 'refund_subscriptions_fk0')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('subscription_plan_id', 'refund_subscriptions_fk1')->references('id')->on('subscription_plan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('refund_subscriptions', function (Blueprint $table) {
			$table->dropForeign('refund_subscriptions_fk0');
			$table->dropForeign('refund_subscriptions_fk1');
		});
	}
}
