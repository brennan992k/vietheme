<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('sm_notifications_001');
            $table->foreign('user_id', 'sm_notifications_001')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('role_id')->nullable()->unsigned()->index('sm_notifications_002');
            $table->foreign('role_id', 'sm_notifications_002')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('ticket_id')->nullable();
            $table->date('date')->nullable();
            $table->string('message', 255)->nullable();
            $table->integer('received_id')->nullable();
            $table->string('link', 255)->nullable();
            $table->boolean('is_read')->default(0);
            $table->boolean('active_status')->default(1);
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
        Schema::dropIfExists('sm_notifications');
    }
}
