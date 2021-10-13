<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfixTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_tickets', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->nullable()->unsigned()->index('infix_tickets_0001');
            $table->foreign('user_id', 'infix_tickets_0001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('user_agent')->nullable()->unsigned()->index('infix_tickets_008');
            $table->foreign('user_agent', 'infix_tickets_008')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('category_id')->nullable()->unsigned()->index('infix_tickets_002');
            $table->foreign('category_id', 'infix_tickets_002')->references('id')->on('infix_ticket_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('priority_id')->nullable()->unsigned()->index('infix_tickets_003');
            $table->foreign('priority_id', 'infix_tickets_003')->references('id')->on('infix_ticket_priorities')->onUpdate('RESTRICT')->onDelete('RESTRICT');

			$table->integer('department_id')->nullable()->unsigned()->index('infix_tickets_00444');
            $table->foreign('department_id','infix_tickets_00444')->references('id')->on('infix_departments')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->string('subject');
            $table->string('author')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active_status')->default(0);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
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
        Schema::dropIfExists('infix_tickets');
    }
}