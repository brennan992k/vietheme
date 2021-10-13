<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInfixFooterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_footer_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('copyright_text');
            $table->string('icon1')->nullable();
            $table->string('url1')->nullable();
            $table->string('icon2')->nullable();
            $table->string('url2')->nullable();
            $table->string('icon3')->nullable();
            $table->string('url3')->nullable();
            $table->string('icon4')->nullable();
            $table->string('url4')->nullable();
            $table->string('icon5')->nullable();
            $table->string('url5')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
        });

        DB::table('infix_footer_settings')->insert([
            [
                'copyright_text'    => 'Copyright © 2020 All rights reserved | This application is made by Codethemes',
                'icon1'             => 'fa-facebook',
                'url1'              => 'https://www.facebook.com/',
                'icon2'             => 'fa-twitter',
                'url2'              => 'https://www.twitter.com',
                'icon3'             => 'fa-instagram',
                'url3'              => 'https://www.instagram.com',
                'icon4'             => 'fa-youtube',
                'url4'              => 'https://www.youtube.com',
                'icon5'             => 'fa-pinterest',
                'url5'              => 'https://www.pinterest.com',
                'address'           => 'Dhaka',
                'phone'             => '12345678549',
                'email'             => 'info@spondonit.com',
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
        Schema::dropIfExists('infix_footer_settings');
    }
}
