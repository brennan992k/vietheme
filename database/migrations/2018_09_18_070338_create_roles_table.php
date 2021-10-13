<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function (Blueprint $table) {
			$table->increments ('id', true);
			$table->string('name');
			$table->boolean('status')->default(1);
			$table->timestamps();
		});

		DB::table('roles')->insert([
			[
				'name' => 'Super admin', // 1
			],
			[
				'name' => 'Agent', // 2
			],
			[
				'name' => 'Operator', // 3
			],
			[
				'name' => 'Author', // 4
			],
			[
				'name' => 'Customer', // 5
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
		Schema::drop('roles');
	}
}
