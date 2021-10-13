<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        $modules = ['Dashboard', 'User Management', 'Offline Payment', 'Bank Payment', 'Product', 'Product Update List', 'Product Pending List', 'Product Order', 'Refund Order', 'Buyer Fee', 'Author Level', 'Coupon', 'Knowledge Bage', 'Tax', 'Payment', 'Promotional', 'Recaptcha', 'Ticket', 'Reports', 'System Settings', 'Frontend CMS', 'Front Settings'];

        foreach ($modules as $module) {
            DB::table('modules')->insert([
                [
                    'name' => $module,
                    'created_at' => date('Y-m-d h:i:s')
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
        Schema::dropIfExists('modules');
    }
}
