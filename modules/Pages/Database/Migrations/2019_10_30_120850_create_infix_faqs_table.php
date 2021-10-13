<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfixFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_title', 255)->nullable();
            $table->text('question_answer')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        DB::table('infix_faqs')->insert(
            [
                'question_title'       => 'On which orders D-Force will be eligible for bonus?',
                'question_answer'       => 'BDT 100 will be given to D-Force on customer’s first purchase (via Daraz App) made through the link shared',
            ]
        );
        DB::table('infix_faqs')->insert(
            [
                'question_title'       => 'Is bonus applicable on sales made using a voucher?',
                'question_answer'       => 'Yes. Bonus is applicable on sales as long as the paid price is equal to or above BDT 500.',
            ]
        );

        DB::table('infix_faqs')->insert(
            [
                'question_title'       => 'Is bonus applicable on sales made using a voucher?',
                'question_answer'       => 'Yes. Bonus is applicable on sales as long as the paid price is equal to or above BDT 500.',
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
        Schema::dropIfExists('infix_faqs');
    }
}
