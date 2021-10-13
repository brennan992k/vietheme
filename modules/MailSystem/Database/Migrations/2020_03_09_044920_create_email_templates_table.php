<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('registration')->nullable();
            $table->longText('mail_verify')->nullable();
            $table->longText('product_purchase')->nullable();
            $table->longText('product_refund')->nullable();
            $table->longText('rating')->nullable();
            $table->longText('product_update')->nullable();
            $table->longText('product_comment')->nullable();
            $table->longText('user_suspend')->nullable();
            $table->longText('product_review_by_buyer')->nullable();
            $table->longText('product_expiring_support')->nullable();
            $table->longText('daily_summary')->nullable();
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });

        DB::table('email_templates')->insert([
            [
                'rating' => 'Dear , [username], your product got rating [rating].',
                'registration' => 'Dear,[username], thank you for registration',
                'product_purchase' => 'Dear,[username], thank you for purchase',
                'mail_verify' => 'Dear,[username], please verify you email',
                'product_refund' => 'Dear,[username], your refund request approved!',
                'product_update' => 'Dear,[username], your bought product [title] updated!',
                'user_suspend' => 'Dear,[username], you are suspend!',
                'product_comment' => 'Dear, A new comment has been arraived right now',
                'product_review_by_buyer' => 'Dear, This item has been reviewed by buyer',
                'product_expiring_support' => 'Dear, Your product support has been expaired',
                'daily_summary' => 'Dear, Congratulation for salling item. Your daily summery has been attached.',

            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
}
