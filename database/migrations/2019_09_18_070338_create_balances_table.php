<?php

use App\Balance;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBalancesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('balances', function (Blueprint $table) {
			$table->increments('id', true);
			$table->integer('user_id')->unsigned()->index('balances_fk0');
			$table->boolean('type');
			$table->float('amount', 10, 2);
			$table->timestamps();
		});

		DB::table('balances')->insert([
			[
				'user_id' => 1,
				'type'   => 1,
				'amount' => 25,
			]
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('balances');
	}
}
