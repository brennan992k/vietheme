<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading');
            $table->text('heading_text');
            $table->string('heading2');
            $table->text('heading2_text');
            $table->tinyInteger('active_status')->default(1); 
            $table->integer('created_by')->nullable()->default(1)->unsigned();  
            $table->integer('updated_by')->nullable()->default(1)->unsigned(); 
            $table->timestamps();
        });

        DB::table('license_pages')->insert(
            [
                'heading'=>'Standard Licenses',
                'heading_text'   =>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic iure architecto quaerat temporibus rem delectus ipsum eius rerum, iusto quibusdam eaque doloremque, consequatur repudiandae.',
                'heading2' =>'Note To Freelancers And Creative Agencies',
                'heading2_text' =>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa iure cumque error officia, quae ullam soluta repudiandae eligendi. Est similique ea, accusamus quidem vitae dolorem ratione explicabo quas, quae alias ab eos voluptas omnis dicta sed vel reprehenderit quaerat sint.',
            ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_pages');
    }
}
