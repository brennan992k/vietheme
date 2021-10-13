<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBecomeAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('become_authors', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description')->nullable();

            $table->timestamps();
        });

        DB::table('become_authors')->insert(
            [
                'description'         => "<h2>Let's Started</h2><p>These things you need to know become an author</p><p>We live for quality and originality</p><p>Only the best Authors and items make it through our review process.This way we make sure that all products meet our quality standards.</p><p>Make it lcear and meaningfull</p><p>The most successfull Authors put as much love into describing and presenting their items as they do in creating them.</p><p>Great reviews come from great support</p><p>The key to your success is your customers so make sure you help and support them as much as you can.</p>",
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('become_authors');
    }
}
