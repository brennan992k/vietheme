<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlanTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_plan', function (Blueprint $table) {
			$table->increments('id', true);
			$table->integer('vendor_id')->unsigned()->index('subscription_plan_fk0');
			$table->string('name', 191);
			$table->float('price', 10, 0);
			$table->integer('item_amount');
			$table->boolean('status');
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
		Schema::drop('subscription_plan');
	}
}
