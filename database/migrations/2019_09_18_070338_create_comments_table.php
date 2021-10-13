<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function (Blueprint $table) {
			$table->increments('id', true);
			$table->integer('user_id')->unsigned()->index('comments_fk0');
			$table->integer('item_id')->unsigned()->index('comments_fk1');
			$table->integer('parent_id')->nullable()->unsigned()->index('comments_fk2');
			$table->text('body', 65535);
			$table->boolean('status')->default(1);
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
		Schema::drop('comments');
	}
}
