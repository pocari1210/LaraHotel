<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('roles')->insert([
      [
        'id' => '1',
        'name' => 'SuperAdmin',
        'guard_name' => 'web',
      ],
      [
        'id' => '2',
        'name' => 'Admin',
        'guard_name' => 'web',
      ],
      [
        'id' => '3',
        'name' => 'Receptionist',
        'guard_name' => 'web',
      ],
      [
        'id' => '4',
        'name' => 'Account',
        'guard_name' => 'Manager',
      ],
    ]);
  }
}
