<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInfixProfileSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_profile_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading1');
            $table->text('text1');
            $table->string('heading2');
            $table->text('text2');
            $table->string('heading3');
            $table->text('text3');
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        DB::table('infix_profile_settings')->insert(
            [
                'heading1' => 'Personal Information',
                'text1' => 'We do not sell or share your details without your permission. Find out more in our Privacy Policy.',
                'heading2' => 'Change Password',
                'text2' => 'Change your password..',
                'heading3' => 'Billing Information',
                'text3' => 'We do not sell or share your details without your permission. Find out more in our Privacy Policy.',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_profile_settings');
    }
}
