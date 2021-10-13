<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInfixBackgroundSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_background_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('color', 255)->nullable();
            $table->text('additional_text')->nullable();
            $table->integer('is_default')->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });


        DB::table('infix_background_settings')->insert([

            [
                'id'            => 1,
                'title'         => 'Logo',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/3.png',
                'color'         => '',
                'additional_text' => '',
                'active_status' => 1,
            ],
            [
                'id'            => 2,
                'title'         => 'Favicon',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/2.png',
                'color'         => '',
                'additional_text' => '',
                'active_status' => 1,
            ],

            [
                'id'            => 3,
                'title'         => 'Dashboard Background Image',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/4.jpg',
                'color'         => '',
                'additional_text' => '',
                'active_status' => 1,
            ],
            [
                'id'            => 4,
                'title'         => 'Login/ Signup Background Image',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/5.png',
                'color'         => '',
                'additional_text'         => '<h3 style="margin-right: 0px; margin-bottom: 39px; margin-left: 0px; padding: 0px; font-family: Quicksand, sans-serif; font-weight: 700; line-height: 45px; color: rgb(255, 255, 255); font-size: 32px;">Tons of premium<br style="margin: 0px; padding: 0px;">Templates are<br style="margin: 0px; padding: 0px;">Waiting for you!</h3><h3 style="margin-right: 0px; margin-bottom: 39px; margin-left: 0px; padding: 0px; font-family: Quicksand, sans-serif; font-weight: 700; line-height: 45px; font-size: 32px;"><p style="margin-right: 0px; margin-bottom: 13px; margin-left: 0px; padding: 0px; font-size: 14px; font-weight: 300; line-height: 26px; color: rgb(255, 255, 255); font-family: &quot;Open Sans&quot;, sans-serif;">There are advances being made in science<br style="margin: 0px; padding: 0px;">and technology everyday, and a good<br style="margin: 0px; padding: 0px;">example of this is the</p></h3><p></p>',
                'active_status' => 1,
            ],
            [
                'id'            => 5,
                'title'         => '404 Image',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/404.png',
                'color'         => '',
                'additional_text' => '<h4 style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-weight: 600; line-height: 1.2; color: rgb(0, 0, 0); font-size: 30px; text-align: center;">Page You Are Looking<span style="display: block; color: rgb(239, 239, 239);">Is Not Found</span></h4><p style="margin: 20px 0px; font-size: 18px; color: rgb(51, 51, 51); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: center;">The page you are looking for does not exist. it may have been moved or removed altogether. Perhaps you can return back to the site homepage and see if you can find what you are looking for.</p>',
                'active_status' => 1,
            ],
            [
                'id'            => 6,
                'title'         => 'Pre Loader',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/1.gif',
                'color'         => '',
                'additional_text' => '',
                'active_status' => 0,

            ],
            [
                'id'            => 7,
                'title'         => 'OOPs Image',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/7.jpeg',
                'color'         => '',
                'additional_text' => '',
                'active_status' => 0,

            ],
            [
                'id'            => 8,
                'title'         => 'Success Image',
                'type'          => 'image',
                'image'         => 'Modules/Systemsetting/upload_image/8.jpg',
                'color'         => '',
                'additional_text' => '',
                'active_status' => 0,

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
        Schema::dropIfExists('infix_background_settings');
    }
}
