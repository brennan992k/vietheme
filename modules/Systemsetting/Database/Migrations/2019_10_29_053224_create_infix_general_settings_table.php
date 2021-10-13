<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfixGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('system_name')->nullable();
            $table->string('system_title')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('currency')->nullable()->default('USD');
            $table->string('currency_symbol')->nullable()->default('$');
            $table->string('email_driver')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('last_updated_date')->nullable();
            $table->string('system_version')->nullable()->default('1.0');
            $table->date('system_activated_date')->nullable();
            $table->integer('active_status')->nullable()->default(1);
            $table->string('currency_code')->nullable()->default('USD');
            $table->string('language_name')->nullable()->default('en');
            $table->string('system_purchase_code')->nullable();
            $table->string('envato_user')->nullable();
            $table->string('envato_item_id')->nullable();
            $table->string('system_domain')->nullable();
            $table->string('copyright_text')->nullable();
            $table->integer('api_url')->default(1);
            $table->string('software_version', 100)->nullable();
            $table->integer('ttl_rtl')->default(2);
            $table->integer('time_zone_id')->nullable();
            $table->integer('is_s3_host')->nullable()->default(0);
            $table->integer('KnowledgeBase')->default(1);
            $table->integer('MailSystem')->default(1);
            $table->integer('Newsletter')->default(1);
            $table->integer('Pages')->default(1);
            $table->integer('Refund')->default(1);
            $table->integer('Systemsetting')->default(1);
            $table->integer('Tax')->default(1);
            $table->integer('Ticket')->default(1);
            $table->integer('HumanResource')->default(1);
            $table->integer('auto_approve')->nullable()->default('0');
            $table->integer('auto_update')->nullable()->default('0');
            $table->integer('google_an')->nullable()->default('1');
            $table->integer('public_vendor')->nullable()->default('1');
            $table->integer('language_id')->nullable()->default(1)->unsigned();
            $table->integer('date_format_id')->nullable()->default(1)->unsigned();
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        DB::table('infix_general_settings')->insert([
            [
                'copyright_text' => 'Copyright &copy; 2019 All rights reserved | This template is made with <span class="ti-heart"> </span> by Codethemes',
                'logo' => 'public/uploads/settings/logo.png',
                'favicon' => 'public/uploads/settings/favicon.png',
                'currency' => 'USD',
                'phone' => '407-361-6350',
                'email' => 'support@spondonit.com',
                'address' => '360 Ocala Street Winter Park, FL 32789',
                'system_name' => 'InfixHub',
                'system_title' => 'Digital Market Place',
                'software_version' => '2.2',
                'system_domain' => url('/'),
                'system_activated_date' => date('Y-m-d'),
                'time_zone_id' => 51,
                'language_id' => 19
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
        Schema::dropIfExists('infix_general_settings');
    }
}
