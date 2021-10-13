<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id', true);
			$table->integer('role_id')->unsigned()->index('users_fk0');
			$table->string('username', 191)->unique();
			$table->string('full_name', 191)->nullable();
			$table->string('email', 100)->unique('email');
			$table->string('password', 191)->nullable();
			$table->boolean('verified')->default(0);
			$table->timestamp('email_verified_at')->nullable();
			$table->string('remember_token')->nullable();
			$table->string('verification_token')->nullable();

			$table->string('api_token', 80)
				->unique()
				->nullable()
				->default(null);


			$table->boolean('status')->default(0);
			$table->softDeletes();
			$table->boolean('access_status')->default(1);
			$table->integer('style_id')->nullable();
			$table->string('lang_id')->nullable();
			$table->integer('rtl')->nullable()->default(0);
			$table->integer('referrer_id')->nullable()->unsigned()->index('refer_001');
			$table->foreign('referrer_id', 'refer_001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->string('referral_token')->nullable()->unique();
			$table->timestamps();
		});

		DB::table('users')->insert([
			[
				'role_id' => 1,
				'email'   => 'admin@gmail.com',
				'username' => 'Super Admin',
				'full_name' => 'Super Admin',
				'password' => Hash::make('admin'),
				'api_token' => Str::random(60),
				'email_verified_at' => Carbon::now(),
				'status' => 1,
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
		Schema::drop('users');
	}
}
