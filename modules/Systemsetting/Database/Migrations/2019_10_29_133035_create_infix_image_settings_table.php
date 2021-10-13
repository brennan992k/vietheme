<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfixImageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_image_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pre_loader', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('home_background_image', 255)->nullable();
            $table->string('login_signup_background', 255)->nullable();
            $table->string('default_image', 255)->nullable();
            $table->string('image_404', 255)->nullable();
            $table->string('oops_image', 255)->nullable();
            $table->string('success_image', 255)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
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
        Schema::dropIfExists('infix_image_settings');
    }
}
