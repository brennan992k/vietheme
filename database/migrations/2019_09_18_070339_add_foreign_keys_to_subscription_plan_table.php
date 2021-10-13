<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubscriptionPlanTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscription_plan', function (Blueprint $table) {
			$table->foreign('vendor_id', 'subscription_plan_fk0')->references('id')->on('vendors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subscription_plan', function (Blueprint $table) {
			$table->dropForeign('subscription_plan_fk0');
		});
	}
}
