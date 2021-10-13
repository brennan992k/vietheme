<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_sub_categories', function(Blueprint $table)
		{
			$table->increments('id', true);
			$table->integer('item_category_id')->unsigned()->index('item_sub_categories_fk0');
			$table->string('title',255)->nullable();
			$table->string('slug',255)->nullable();
			$table->string('description',255)->nullable();
			$table->integer('show_menu')->nullable();
            $table->boolean('active_status')->default(1);
			$table->timestamps();
		});
		DB::table('item_sub_categories')->insert([
            [
                'title' => 'WordPress',    
                'slug' => 'wordpress',    
                'description' => 'this is WordPress',
				'item_category_id' => 1,
				'show_menu' => 1,
			],
            [
                'title' => 'Advertising',    
                'slug' => 'advertising',    
                'description' => 'this is Advertising',
				'item_category_id' => 1,
				'show_menu' => 1,
			],
            [
                'title' => 'SEO',    
                'slug' => 'seo',    
                'description' => 'this is SEO',
				'item_category_id' => 1,
				'show_menu' => 1,
			],
            [
                'title' => 'Media',    
                'slug' => 'media',    
                'description' => 'this is Media',
				'item_category_id' => 1,
				'show_menu' => 1,
			],
            [
                'title' => 'Utilities',    
                'slug' => 'utilities',    
                'description' => 'this is Utilities',
				'item_category_id' => 1,
				'show_menu' => 1,
			],
            [
                'title' => 'Creative',    
                'slug' => 'creative',    
				'description' => 'this is Creative',
				'item_category_id' => 3,
				'show_menu' => 1,
			],
            [
                'title' => 'Canvas',    
                'slug' => 'canvas',    
				'description' => 'this is Canvas',
				'item_category_id' => 3,
				'show_menu' => 1,
			],
            [
                'title' => 'Form',    
                'slug' => 'form',    
				'description' => 'this is Form',
				'item_category_id' => 3,
				'show_menu' => 1,
			],
			[
                'title' => 'Web Template',    
                'slug' => 'web_template',    
				'description' => 'this is Web Template',
				'item_category_id' => 3,
				'show_menu' => 1,
			],
			[
                'title' => 'Email Template',    
                'slug' => 'email_template',    
				'description' => 'this is Email Template',
				'item_category_id' => 3,
				'show_menu' => 1,
			],
           
            [
                'title' => 'Email Template',    
                'slug' => 'email_template',    
				'description' => 'this is Email Template',
				'item_category_id' => 4,
				'show_menu' => 1,
			],
			[
                'title' => 'Drupal',    
                'slug' => 'drupal',    
				'description' => 'this is Drupal',
				'item_category_id' => 5,
				'show_menu' => 1,
			],
			[
                'title' => 'Magneto',    
                'slug' => 'magneto',    
				'description' => 'this is Magneto',
				'item_category_id' => 6,
				'show_menu' => 1,
			],
			[
                'title' => 'Corporate',    
                'slug' => 'corporate',    
				'description' => 'this is Corporate',
				'item_category_id' => 7,
				'show_menu' => 1,
			],
			[
                'title' => 'PSD Template',    
                'slug' => 'psd_template',    
				'description' => 'this is UI Design',
				'item_category_id' => 8,
				'show_menu' => 1,
			],
			[
                'title' => 'Business Logo Maker',    
                'slug' => 'business_logo_maker',    
				'description' => 'this is Business Logo Maker',
				'item_category_id' => 10,
				'show_menu' => 1,
			],
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_sub_categories');
	}

}