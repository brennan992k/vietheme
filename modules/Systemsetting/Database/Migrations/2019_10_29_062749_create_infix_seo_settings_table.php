<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInfixSeoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_seo_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name', 255)->nullable();
            $table->string('site_title', 255)->nullable();
            $table->string('site_author', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('keyword', 255)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });
        
        DB::table('infix_seo_settings')->insert([
            [
                'site_name'             => 'Infix Digital Market Place',
                'site_title'            => 'Infix Digital Market Place',
                'site_author'           => 'Infix',
                'description'           => 'Thousands of Products are waiting in Infix Digital Market Place',
                'keyword'               => 'Thousands of Products, Infix, Digital Market Place',
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
        Schema::dropIfExists('infix_seo_settings');
    }
}
