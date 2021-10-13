<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateModulePermissionLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_permission_links', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->string('display_name');
            $table->string('route');
            $table->integer('active_status')->default(1);
            $table->timestamps();
        });

        $sql = "INSERT INTO `module_permission_links` (`id`, `module_id`, `display_name`, `route`, `created_at`, `updated_at`) VALUES
        ('1', 1, 'Dashboard', 'admin/dashboard','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('2', 2, 'department', 'department','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('3', 2, 'User List', 'humanresource/user-list','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('4', 2, 'Author List', 'admin/vendor','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('5', 2, 'customer List', 'admin/customer','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('6', 2, 'agent List', 'admin/agent','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('7', 2, 'user log List', 'admin/user-log','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('8', 2, 'registration bonus', 'admin/registration-bonus','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('9', 3, 'Add Fund', 'admin/add-fund','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('10', 3, 'Fund List', 'admin/fund-list','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('11', 4, 'Bank Deposit Request', 'admin/deposit-request','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('12', 4, 'Deposit Approve', 'admin/deposit-approved','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('13', 5, 'Category(Product)', 'admin/add-category','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('14', 5, 'Sub Category', 'admin/sub-category','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('15', 5, 'attributes', 'admin/attributes','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('16', 5, 'sub-attributes', 'admin/sub-attributes','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('17', 6, 'Product Update List', 'admin/item-preview','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('18', 7, 'Product Pending List', 'admin/item-pending','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('19', 5, 'Product List', 'admin/product','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('20', 5, 'Deactive Product List', 'admin/deactive-products','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('21', 5, 'Free Product List', 'admin/free-product','2020-05-20 03:25:09', '2020-05-20 03:25:09'),


        ('22', 8, 'Order', 'admin/order','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('23', 9, 'Refund Type', 'admin/refund-list','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('24', 9, 'Request Refund Order', 'admin/request-refund-order','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('25', 9, 'Refund Order', 'admin/refund-order','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('26',10, 'Buyer Fee', 'admin/item-fee','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('27',11, 'Label List', 'admin/label','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('28',11, 'badge List', 'admin/badge','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('29',11, 'review type List', 'admin/review-type','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('30',12, 'Coupon Plan', 'admin/coupon','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('31',13, 'Category (Kn. Base)', 'knowledgebase/category','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('32',13, 'Question', 'knowledgebase/category-question','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('33',13, 'Sub Question & Answer', 'knowledgebase/question','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('34',14, 'Tax', 'admin/tax-list','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('35',15, 'Save Credit Card', 'admin/save-credit-card','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('36',15, 'Author Balance', 'admin/paymnet-method','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('37',15, 'Payment Author', 'admin/payable-author','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('38',16, 'Send Mail', 'admin/send-email-sms-view','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('39',17, 'Recaptcha Setting', 'admin/recaptcha-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('40',18, 'Ticket Status', 'ticket/ticket-status','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('41',18, 'Category (Ticket)', 'ticket/ticket-category','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('42',18, 'Priority', 'ticket/ticket-priority','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('43',18, 'Ticket', 'ticket/ticket-list','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('44',19, 'Admin Revenue', 'admin/revenue','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('45',19, 'Author Revenue', 'admin/author-revenue','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        
        ('46',20, 'General Settings', 'systemsetting/general-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('47',20, 'Email Settings', 'systemsetting/email-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('48',20, 'Role Permission', 'systemsetting/role-permission','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('49',20, 'Payment Method Settings', 'systemsetting/payment-method-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('50',20, 'Language Settings', 'systemsetting/language-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('51',20, 'SEO Settings', 'systemsetting/seo-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('52',20, 'Dashboard Themes', 'systemsetting/theme-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('53',20, 'Backup', 'systemsetting/backup-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('54',20, 'Third Party API', 'systemsetting/third-party-api','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('55',20, 'About', 'systemsetting/about-system','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('56',21, 'Home Page', 'pages/home-page','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('57',21, 'Profile Setting', 'pages/profile-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('58',21, 'Coupon', 'pages/coupon-text','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('59',21, 'License', 'pages/license','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('60',21, 'Ticket (Frontend)', 'pages/ticket','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('61',21, 'Privacy Policy', 'pages/privacy-policy','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('62',21, 'Terms Conditions', 'pages/terms-conditions','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('63',21, 'Market API', 'pages/market-apis','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('64',21, 'Item Support', 'pages/item-support','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('65',21, 'About Company', 'pages/about-company','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('66',21, 'FAQ', 'pages/faqs','2020-05-20 03:25:09', '2020-05-20 03:25:09'),

        ('67',22, 'Site Image Settings', 'systemsetting/site-image-setting','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('68',22, 'Footer Menu', 'footer-menug','2020-05-20 03:25:09', '2020-05-20 03:25:09'),
        ('69',22, 'Footer Custom Link', 'systemsetting/footer-custom-link','2020-05-20 03:25:09', '2020-05-20 03:25:09')";

        DB::insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_permission_links');
    }
}
