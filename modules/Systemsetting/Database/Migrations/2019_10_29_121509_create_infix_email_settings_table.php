<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Systemsetting\Entities\InfixEmailSetting;

class CreateInfixEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_email_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_engine_type')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('mail_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        if (Config::get('app.app_sync')) {
            $email                      = new InfixEmailSetting();
            $email->email_engine_type   = 'smtp';
            $email->from_name           = 'System Admin';
            $email->mail_username       = 'office@reseller.spondonit.com';
            $email->from_email          = 'office@reseller.spondonit.com';
            $email->mail_driver         = 'smtp';
            $email->mail_host           = 'smtp.gmail.com';
            $email->mail_port           = '587';
            $email->mail_password       = '123456789';
            $email->mail_encryption     = 'tls';
            $email->save();

            $email                      = new InfixEmailSetting();
            $email->email_engine_type   = 'php';
            $email->from_name           = 'System Admin';
            $email->mail_username       = 'office@reseller.spondonit.com';
            $email->from_email          = 'office@reseller.spondonit.com';
            $email->mail_driver         = 'php';
            $email->mail_host           = '';
            $email->mail_port           = '';
            $email->mail_password       = '';
            $email->mail_encryption     = '';
            $email->active_status       = 0;
            $email->save();
        } else {
            DB::table('infix_email_settings')->insert([
                [
                    'email_engine_type' => 'smtp',
                    'from_name' => 'System Admin',
                    'from_email' => 'demo@gmail.com',
                    'mail_driver' => 'smtp',
                    'mail_host' => 'smtp.gmail.com',
                    'mail_port' => '587',
                    'mail_username' => 'demo@gmail.com',
                    'mail_password' => '123456',
                    'mail_encryption' => 'tls',
                    'active_status' => '1',
                ],
                [
                    'email_engine_type' => 'php',
                    'from_name' => 'System Admin',
                    'from_email' => 'admin@infixedu.com',
                    'mail_driver' => 'php',
                    'mail_host' => '',
                    'mail_port' => '',
                    'mail_username' => '',
                    'mail_password' => '',
                    'mail_encryption' => '',
                    'active_status' => '0',
                ]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_email_settings');
    }
}
