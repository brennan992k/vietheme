<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialIconsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('social_icons', function (Blueprint $table) {
			$table->increments('id', true);
			$table->integer('user_id')->unsigned()->index('social_icons_fk0');
			$table->string('behance', 191)->nullable();
			$table->string('deviantart', 191)->nullable();
			$table->string('digg', 191)->nullable();
			$table->string('dribbble', 191)->nullable();
			$table->string('facebook', 191)->nullable();
			$table->string('flickr', 191)->nullable();
			$table->string('github', 191)->nullable();
			$table->string('google_plus', 191)->nullable();
			$table->string('lastfm', 191)->nullable();
			$table->string('linkedin', 191)->nullable();
			$table->string('reddit', 191)->nullable();
			$table->string('soundcloud', 191)->nullable();
			$table->string('thumblr', 191)->nullable();
			$table->string('twitter', 191)->nullable();
			$table->string('vimeo', 191)->nullable();
			$table->string('youtube', 191)->nullable();
			$table->tinyInteger('status')->default(1);
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
		Schema::drop('social_icons');
	}
}
