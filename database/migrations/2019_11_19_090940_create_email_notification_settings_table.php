<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rating')->nullable();
            $table->tinyInteger('item_update')->nullable();
            $table->tinyInteger('item_comment')->nullable();
            $table->tinyInteger('item_review')->nullable();
            $table->tinyInteger('buyer_review')->nullable();
            $table->tinyInteger('expiring_support')->nullable();
            $table->tinyInteger('daily_summary')->nullable();
            $table->integer('user_id')->unsigned()->index('email_notification_settings_0');
            $table->foreign('user_id','email_notification_settings_0')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('email_notification_settings');
    }
}
