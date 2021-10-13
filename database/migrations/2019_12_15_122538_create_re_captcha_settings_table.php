<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateReCaptchaSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('re_captcha_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200)->nullable();
            $table->string('sitekey', 200)->nullable();
            $table->string('secretkey', 200)->nullable();
            $table->integer('type')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        DB::table('re_captcha_settings')->insert([
            [
                'title' => 'Google Re-captcha',
                'type' => 1,
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
        Schema::dropIfExists('re_captcha_settings');
    }
}
