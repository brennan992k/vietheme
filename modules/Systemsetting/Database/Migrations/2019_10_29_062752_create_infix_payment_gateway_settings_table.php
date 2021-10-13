<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfixPaymentGatewaySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infix_payment_gateway_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo', 255)->nullable();
            $table->longText('env_terms')->nullable()->comments('PAYPAL_CLIENT_ID,PAYPAL_SECRET,PAYPAL_MODE');
            $table->string('is_config_required')->nullable();
            $table->boolean('mode')->default(1);
            $table->string('gateway_name')->nullable();
            $table->longText('gateway_configur')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        DB::table('infix_payment_gateway_settings')->insert([
            [
                'is_config_required'    => 'https://developer.paypal.com/developer/applications/',
                'logo'    => 'public/no_logo.png',
                'gateway_name'          => 'PayPal',
                'env_terms'             => 'PAYPAL_CLIENT_ID:Afth8tuZq5oNpy5VCaQlmuelnB5egFAKHrNwg5aka_tlRC9YpUec9I6IoRc3CNNNd5GsYgyR0JGpF-X6,PAYPAL_CLIENT_SECRET:EKXHVM_WbMqw5sMj1hI4kEe94_w5Ff_-WGHqE3zm-a5I4Dga-2ga7vLZbaA-iI12lWLhBgtMr9XLRXwc,PAYPAL_CURRENCY:USD,PAYPAL_MIN_PAYOUT:50,PAYPAL_MODE:sandbox,',
            ]
        ]);

        DB::table('infix_payment_gateway_settings')->insert([
            [
                'is_config_required'    => 'https://dashboard.stripe.com/dashboard',
                'logo'    => 'public/no_logo.png',
                'gateway_name'          => 'Stripe',
                'env_terms'             => 'STRIPE_KEY:77fgd4g5erer8,STRIPE_SECRET:fsdfwerwef541f7sdfs6d,STRIPE_MIN_PAYOUT:50,',
                'active_status'             => '0',
            ]
        ]);

        DB::table('infix_payment_gateway_settings')->insert([
            [
                'is_config_required'    => 'https://dashboard.razorpay.com/app/config',
                'logo'                  => 'public/no_logo.png',
                'gateway_name'          => 'Razorpay',
                'env_terms'             => 'RAZOR_KEY:s45df67sdwf,RAZOR_SECRET:dsf7s7ef9w6e4f5689,RAZORPAY_MIN_PAYOUT:50,',
            ],
        ]);

        DB::table('infix_payment_gateway_settings')->insert([
            [
                'is_config_required'    => 1,
                'logo'                  => 'public/no_logo.png',
                'gateway_name'          => 'Bank',
                'env_terms'             => 'BANK_NAME:Dhaka_Bank,BRANCH_NAME:Dhaka,ACCOUNT_NUMBER:64687964,ACCOUNT_HOLDER:Digital_marketplace,BANK_MIN_PAYOUT:50,',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infix_payment_gateway_settings');
    }
}
