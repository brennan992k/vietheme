<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->increments('id', true);

			$table->integer('user_id')->nullable()->unsigned()->index('005');
            $table->foreign('user_id','005')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

			$table->integer('category_id')->nullable()->unsigned()->index('007');
            $table->foreign('category_id','007')->references('id')->on('item_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');

			$table->integer('sub_category_id')->nullable()->unsigned()->index('006');
			$table->foreign('sub_category_id','006')->references('id')->on('item_sub_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			
			$table->string('title', 191)->nullable();
			$table->text('feature1')->nullable();
			$table->text('feature2')->nullable();
			$table->longText('description')->nullable();
			$table->string('resolution',50)->nullable();
			$table->string('widget',50)->nullable();

			$table->string('icon')->nullable();
			$table->string('thumbnail')->nullable();
			$table->text('theme_preview')->nullable();
			$table->text('screen_shot')->nullable();
			$table->string('file')->nullable();
			$table->string('main_file')->nullable();
			$table->string('compatible_browsers')->nullable();
			
			$table->string('compatible_with')->nullable();
			
			$table->string('framework')->nullable();
			
			$table->string('software_version')->nullable();
			
			$table->string('columns')->nullable();
			$table->string('layout')->nullable();
			$table->string('demo_url')->nullable();
			$table->text('tags')->nullable();

			$table->float('Re_item',10,2)->nullable();
			$table->float('Re_buyer',10,2)->nullable();
			$table->float('Reg_total',10,2)->nullable();

			$table->float('C_item',10,2)->nullable();
			$table->float('C_buyer',10,2)->nullable();
			$table->float('C_total',10,2)->nullable();

			$table->float('E_item',10,2)->nullable();
			$table->float('E_buyer',10,2)->nullable();
			$table->float('Ex_total',10,2)->nullable();


			$table->longText('user_msg')->nullable();
			$table->integer('sell')->default(0);
			$table->integer('views')->default(0);
			$table->float('rate',10,2)->default(0);
			$table->boolean('status')->default(0);
			$table->boolean('free')->default(0);
			$table->boolean('is_upload')->default(1);
			$table->string('purchase_link')->nullable();
			$table->boolean('active_status')->default(0);
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
		Schema::drop('items');
	}

}
