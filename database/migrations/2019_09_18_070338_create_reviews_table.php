<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function (Blueprint $table) {
			$table->increments('id', true);
			$table->integer('user_id')->nullable()->unsigned()->index('reviews_fk0');

			$table->integer('vendor_id')->nullable()->unsigned()->index('review_01');
			$table->foreign('vendor_id', 'review_01')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

			$table->text('body', 65535)->nullable();
			$table->integer('item_id')->nullable()->unsigned()->index('reviews_fk1');
			$table->integer('order_id')->nullable();
			$table->text('rating')->nullable();
			$table->text('review_type')->nullable();
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
		Schema::drop('reviews');
	}
}
