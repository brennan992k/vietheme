<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAssignModulePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_module_permissions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('permission')->default(1);
            $table->timestamps();
            $table->integer('module_id')->nullable()->unsigned();
            $table->integer('role_id')->nullable()->unsigned();
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
        });
        $sql = "INSERT INTO `assign_module_permissions` (`id`, `permission`, `created_at`, `updated_at`, `module_id`, `role_id`, `created_by`, `updated_by`) VALUES
                (1, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 1, 2, 1, 1),
                (2, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 2, 2, 1, 1),
                (3, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 3, 2, 1, 1),
                (4, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 4, 2, 1, 1),
                (5, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 5, 2, 1, 1),
                (6, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 6, 2, 1, 1),
                (7, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 7, 2, 1, 1),
                (8, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 8, 2, 1, 1),
                (9, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 9, 2, 1, 1),
                (10, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 10, 2, 1, 1),
                (11, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 11, 2, 1, 1),
                (12, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 12, 2, 1, 1),
                (13, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 13, 2, 1, 1),
                (14, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 14, 2, 1, 1),
                (15, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 15, 2, 1, 1),
                (16, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 16, 2, 1, 1),
                (17, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 17, 2, 1, 1),
                (18, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 18, 2, 1, 1),
                (19, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 19, 2, 1, 1),
                (20, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 20, 2, 1, 1),
                (21, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 21, 2, 1, 1),
                (22, 1, '2020-05-20 03:25:09', '2020-05-20 03:25:09', 22, 2, 1, 1)";
        DB::insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_module_permissions');
    }
}
