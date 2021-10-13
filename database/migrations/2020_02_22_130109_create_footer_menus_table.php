<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFooterMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_title');
            $table->string('menu_url');
            $table->tinyInteger('position_no')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        $footer_menus = [
            [
                'menu_title' => "About Company",
                'menu_url' => route('about_company'),
                'position_no' =>  "1",

            ],
            [
                'menu_title' => "Terms & Conditions",
                'menu_url' => route('termsConditions'),
                'position_no' =>  "2",

            ],
            [
                'menu_title' => "Privacy Policy",
                'menu_url' => route('privacyPolicy'),
                'position_no' =>  "3",

            ]
        ];

        DB::table('footer_menus')->insert($footer_menus);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_menus');
    }
}
