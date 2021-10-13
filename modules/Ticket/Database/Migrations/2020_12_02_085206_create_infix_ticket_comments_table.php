<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfixTicketCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_ticket_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('ticket_comments_0012');
            $table->foreign('user_id', 'ticket_comments_0012')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('comment_id')->nullable();
            $table->integer('ticket_id')->unsigned()->index('ticket_comments_0093');
            $table->foreign('ticket_id', 'ticket_comments_0093')->references('id')->on('infix_tickets')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('client_id')->nullable()->unsigned()->index('ticket_comments_0033');
            $table->foreign('client_id', 'ticket_comments_0033')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('file')->nullable();
            $table->longText('comment');
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
        Schema::dropIfExists('infix_ticket_comments');
    }
}
