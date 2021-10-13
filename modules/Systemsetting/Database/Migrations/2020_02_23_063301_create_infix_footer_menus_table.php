<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Systemsetting\Entities\InfixFooterMenu;

class CreateInfixFooterMenusTable extends Migration
{
    //infix_footer_menus
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_footer_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title1', 255)->nullable();
            $table->string('title2', 255)->nullable();
            $table->string('title3', 255)->nullable();

            $table->string('link_label1', 255)->nullable();
            $table->string('link_href1', 255)->nullable();
            $table->string('link_label2', 255)->nullable();
            $table->string('link_href2', 255)->nullable();
            $table->string('link_label3', 255)->nullable();
            $table->string('link_href3', 255)->nullable();
            $table->string('link_label13', 255)->nullable();
            $table->string('link_href13', 255)->nullable();

            $table->string('link_label5', 255)->nullable();
            $table->string('link_href5', 255)->nullable();
            $table->string('link_label6', 255)->nullable();
            $table->string('link_href6', 255)->nullable();
            $table->string('link_label7', 255)->nullable();
            $table->string('link_href7', 255)->nullable();
            $table->string('link_label14', 255)->nullable();
            $table->string('link_href14', 255)->nullable();

            $table->string('link_label9', 255)->nullable();
            $table->string('link_href9', 255)->nullable();
            $table->string('link_label10', 255)->nullable();
            $table->string('link_href10', 255)->nullable();
            $table->string('link_label11', 255)->nullable();
            $table->string('link_href11', 255)->nullable();
            $table->string('link_label15', 255)->nullable();
            $table->string('link_href15', 255)->nullable();


            $table->timestamps();
        });


        $s = new InfixFooterMenu();
        $s->title1 = 'Company';
        $s->title2 = 'Community';
        $s->title3 = 'Help';

        $s->link_label1 = 'Terms & Condition';
        $s->link_href1  = route('termsConditions');

        $s->link_label2 = 'Licenses';
        $s->link_href2  = route('License');

        $s->link_label3 = 'Market APIs';
        $s->link_href3  = route('marketApis');

        $s->link_label13 = 'Forums';
        $s->link_href13  = '';

        $s->link_label5 = 'Meetups';
        $s->link_href5  = '';

        $s->link_label6 = 'Support Ticket';
        $s->link_href6  = '/support-ticket';

        $s->link_label7 = 'FAQ';
        $s->link_href7  = route('faqPage');

        $s->link_label14 = 'Knowledge Base';
        $s->link_href14  = route('knowledgeBase');
        // $s->link_href14  = url('/').'/help/knowledge-base';

        $s->link_label9  = 'Help Center';
        $s->link_href9   = '';

        $s->link_label10 = 'About';
        $s->link_href10  = '';


        $s->link_label11 = 'Contact';
        $s->link_href11  = '';

        $s->link_label15 = 'link_label15';
        $s->link_href15  = '';
        $s->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_footer_menus');
    }
}
