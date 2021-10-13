<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateItemCategoriesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_categories', function (Blueprint $table) {
			$table->increments('id', true);
			$table->string('title', 255)->nullable();
			$table->string('slug', 255)->nullable();
			$table->string('description', 255)->nullable();
			$table->boolean('up_permission')->nullable();
			$table->boolean('file_permission')->nullable();
			$table->integer('position')->nullable();
			$table->string('recommended_price')->nullable();
			$table->string('recommended_price_extended')->nullable();
			$table->string('recommended_price_commercial')->nullable();
			$table->integer('show_menu')->nullable();
			$table->boolean('active_status')->default(1);
			$table->timestamps();
		});

		DB::table('item_categories')->insert([
			[
				'title' => 'Wordpress',    
				'slug' => 'wordpress',    
				'description' => 'this is Wordpress',
				'file_permission' => 1,
				'up_permission' => 1,
				'position' => 1,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
			[
				'title' => 'Hosting',    
				'slug' => 'hosting',    
				'description' => 'this is HTML',
				'file_permission' => 1,
				'up_permission' => 2,
				'position' => 9,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,

			],
			[
				'title' => 'HTML',    
				'slug' => 'html',    
				'description' => 'this is HTML',
				'file_permission' => 1,
				'up_permission' => 1,
				'position' => 3,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],

			[
				'title' => 'Marketing',    
				'slug' => 'marketing',    
				'description' => 'this is Marketing',
				'file_permission' => 1,
				'up_permission' => 1,
				'position' => 4,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
			[
				'title' => 'CMS',    
				'slug' => 'cms',    
				'description' => 'this is CMS',
				'file_permission' => 1,
				'up_permission' => 1,
				'position' => 5,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
			[
				'title' => 'eCommerce',    
				'slug' => 'ecommerce',    
				'description' => 'this is eCommerce',
				'file_permission' => 1,
				'up_permission' => 1,
				'position' => 6,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
			[
				'title' => 'Muse',    
				'slug' => 'muse',    
				'description' => 'this is Muse',
				'file_permission' => 2,
				'up_permission' => 1,
				'position' => 7,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
			[
				'title' => 'UI Design',    
				'slug' => 'ui_design',    
				'description' => 'this is UI Design',
				'file_permission' => 2,
				'up_permission' => 2,
				'position' => 8,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
			[
				'title' => 'Plugins',    
				'slug' => 'plugins',    
				'description' => 'this is Plugins',
				'file_permission' => 1,
				'up_permission' => 2,
				'position' => 2,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
			[
				'title' => 'Logo Maker',    
				'slug' => 'logo_maker',    
				'description' => 'this is Logo Maker',
				'file_permission' => 1,
				'up_permission' => 2,
				'position' => 10,
				'recommended_price' => '45-67',
				'recommended_price_extended' => '150-170',
				'recommended_price_commercial' => '75-90',
				'show_menu' => 1,
			],
		]);

		$categories = DB::table('item_categories')->get();

		foreach ($categories as $key => $category) {
			DB::table('sub_attributes')->insert([
				[
					'name' => 'IE6',    
					'attributes_id' => 1,
					'category_id' => $category->id,
				],
				[
					'name' => 'IE7',    
					'attributes_id' => 1,
					'category_id' => $category->id,
				],
				[
					'name' => 'bbPress 2.4 x',    
					'attributes_id' => 2,
					'category_id' => $category->id,
				],
				[
					'name' => 'bbPress 2.5 x',    
					'attributes_id' => 2,
					'category_id' => $category->id,
				],
				[
					'name' => 'Layers WP',    
					'attributes_id' => 3,
					'category_id' => $category->id,
				],
				[
					'name' => 'Genesis',    
					'attributes_id' => 3,
					'category_id' => $category->id,
				],
				[
					'name' => 'WordPress5.5.x',    
					'attributes_id' => 4,
					'category_id' => $category->id,
				],
				[
					'name' => 'WordPress5.4.x',    
					'attributes_id' => 4,
					'category_id' => $category->id,
				],
			]);
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_categories');
	}
}
