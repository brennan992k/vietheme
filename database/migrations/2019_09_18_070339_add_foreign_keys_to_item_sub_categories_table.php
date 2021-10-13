<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('item_sub_categories', function(Blueprint $table)
		{
			$table->foreign('item_category_id', 'item_sub_categories_fk0')->references('id')->on('item_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('item_sub_categories', function(Blueprint $table)
		{
			$table->dropForeign('item_sub_categories_fk0');
		});
	}

}
