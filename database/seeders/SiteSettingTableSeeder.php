<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SiteSettingTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('site_settings')->insert([

      [
        'id' => 1,
        'logo' => 'storage\upload\site\logo-1.png',
        'phone' => '03-1234-5678',
        'address' => '123 Virgil A Stanton, Virginia, USA',
        'email' => 'info@LaraHotel.com',
        'facebook' => '#',
        'twitter' => '#',
        'copyright' => 'Copyright @2023 Atoli. All Rights Reserved by LaraHotel',
      ],

    ]);
  }
}
