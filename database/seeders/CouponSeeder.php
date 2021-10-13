<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [20, 30, 40, 50];
    foreach ($data as $key => $value) {
      $coupon = new Coupon();
      $coupon->vendor_id = 2;
      $coupon->min_price = 2;
      $coupon->coupon_code = bin2hex(random_bytes(5));
      $coupon->coupon_type = 0;
      $coupon->discount = 1 + $key . '0';
      $coupon->discount_type = 1;
      $coupon->from = date("Y-m-d", strtotime("today"));
      $coupon->to = date("Y-m-d", strtotime("+1 month"));
      $coupon->save();
    }
  }
}
