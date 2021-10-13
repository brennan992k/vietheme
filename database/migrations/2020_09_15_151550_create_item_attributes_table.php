<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('item_attributes');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::create('item_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->unsigned();
            $table->string('field_name')->nullable();
            $table->string('values')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_attributes');
    }
}
