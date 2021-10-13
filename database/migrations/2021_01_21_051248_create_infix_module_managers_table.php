<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInfixModuleManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_module_managers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('notes', 255)->nullable();
            $table->string('version', 200)->nullable();
            $table->string('update_url', 200)->nullable();
            $table->string('purchase_code', 200)->nullable();
            $table->string('installed_domain', 200)->nullable();
            $table->date('activated_date', 200)->nullable();
            $table->integer('is_default')->default(0);
            $table->timestamps();
        });

        try {
            $infixModuleManagers = [];

            // MailSystem
            $dataPath = 'Modules/MailSystem/MailSystem.json';
            $name = 'MailSystem';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // Newsletter
            $dataPath = 'Modules/Newsletter/Newsletter.json';
            $name = 'Newsletter';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // Pages
            $dataPath = 'Modules/Pages/Pages.json';
            $name = 'Pages';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // Refund
            $dataPath = 'Modules/Refund/Refund.json';
            $name = 'Refund';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // Systemsetting
            $dataPath = 'Modules/Systemsetting/Systemsetting.json';
            $name = 'Systemsetting';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // Tax
            $dataPath = 'Modules/Tax/Tax.json';
            $name = 'Tax';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // Ticket
            $dataPath = 'Modules/Ticket/Ticket.json';
            $name = 'Ticket';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // HumanResource
            $dataPath = 'Modules/HumanResource/HumanResource.json';
            $name = 'HumanResource';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            // KnowledgeBase
            $dataPath = 'Modules/KnowledgeBase/KnowledgeBase.json';
            $name = 'KnowledgeBase';
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            $version = $array[$name]['versions'][0];
            $url = $array[$name]['url'][0];
            $notes = $array[$name]['notes'][0];

            $infixModuleManagers[] = [
                'name'  => $name,
                'email' => 'support@vietheme.com',
                'note'  => $notes,
                'version' => $version,
                'update_url' => $url,
                'purchase_code' => time(),
                'installed_domain' => url('/'),
                'activated_date' => date('Y-m-d'),
                'is_default' => 1,
            ];

            DB::table('infix_module_managers')->insert($infixModuleManagers);
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_module_managers');
    }
}
