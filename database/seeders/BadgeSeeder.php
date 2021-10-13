<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $data = ['Start Year', 'first Year', 'Second Year', 'Third Year', 'Fourth Year', 'Fifth Year'];
    $i = 0;
    $j = 0;
    foreach ($data as $key => $value) {
      $badge = new Badge();
      $badge->name = $value;
      $badge->day = $i;
      $badge->icon = 'public/uploads/badge/' . 'icon-0.png';
      $badge->time = $j++;
      $badge->save();
      $i = $badge->day + 365;
    }
  }
}
