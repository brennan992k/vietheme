<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLicenseFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_features', function (Blueprint $table) {
            $table->id();
            $table->string('feature_title');
            $table->tinyInteger('regular')->default(1);
            $table->tinyInteger('extended')->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        $license_features = [
            [
                'feature_title' => "Number of end products",
                'regular' => 1,
                'extended' => 1,
            ],
            [
                'feature_title' => "Use in a single end product",
                'regular' => 1,
                'extended' => 0,
            ],
            [
                'feature_title' => "Use in a free end product",
                'regular' => 1,
                'extended' => 0,
            ],
            [
                'feature_title' => "Use in an end product that's sold",
                'regular' => 1,
                'extended' => 0,
            ],
            [
                'feature_title' => "On-demand products/services",
                'regular' => 1,
                'extended' => 0,
            ],
            [
                'feature_title' => "Use in stock items/templates",
                'regular' => 1,
                'extended' => 0,
            ],
        ];

        DB::table('license_features')->insert($license_features);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_features');
    }
}
