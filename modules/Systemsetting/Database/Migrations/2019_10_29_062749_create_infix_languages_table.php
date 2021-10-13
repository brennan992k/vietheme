<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Systemsetting\Entities\InfixLanguage;

class CreateInfixLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language_name')->nullable();
            $table->string('native')->nullable();
            $table->string('language_universal')->nullable();
            $table->integer('lang_id')->nullable()->default(1)->unsigned();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        $store = new InfixLanguage();
        $store->language_name = 'English';
        $store->native = 'English';
        $store->language_universal = 'en';
        $store->lang_id = '19';
        $store->active_status = 1;
        $store->save();


        // $store = new InfixLanguage();
        // $store->language_name ='Spanish';
        // $store->native ='Español';
        // $store->language_universal ='es';
        // $store->active_status =0;
        // $store->save();

        // $store = new InfixLanguage();
        // $store->language_name ='French';
        // $store->native ='Français';
        // $store->language_universal ='fr';
        // $store->active_status =0;
        // $store->save();

        // $store = new InfixLanguage();
        // $store->language_name ='Bengali';
        // $store->native ='বাংলা';
        // $store->language_universal ='bn';
        // $store->active_status =0;
        // $store->save();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_languages');
    }
}
