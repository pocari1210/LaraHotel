<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PermissionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('permissions')->insert([
      [
        'id' => '1',
        'name' => 'team.menu',
        'guard_name' => 'web',
        'group_name' => 'Team',
      ],
      [
        'id' => '2',
        'name' => 'team.all',
        'guard_name' => 'web',
        'group_name' => 'Team',
      ],
      [
        'id' => '3',
        'name' => 'team.add',
        'guard_name' => 'web',
        'group_name' => 'Team',
      ],
      [
        'id' => '4',
        'name' => 'team.edit',
        'guard_name' => 'web',
        'group_name' => 'Team',
      ],
      [
        'id' => '5',
        'name' => 'team.delete',
        'guard_name' => 'web',
        'group_name' => 'Team',
      ],
      [
        'id' => '6',
        'name' => 'bookarea.menu',
        'guard_name' => 'web',
        'group_name' => 'Book Area',
      ],
      [
        'id' => '7',
        'name' => 'bookarea.update',
        'guard_name' => 'web',
        'group_name' => 'Book Area',
      ],
      [
        'id' => '8',
        'name' => 'room.type.menu',
        'guard_name' => 'web',
        'group_name' => 'Manage Room',
      ],
      [
        'id' => '9',
        'name' => 'room.type',
        'guard_name' => 'web',
        'group_name' => 'Manage Room',
      ],
      [
        'id' => '10',
        'name' => 'booking.menu',
        'guard_name' => 'web',
        'group_name' => 'Booking',
      ],
      [
        'id' => '11',
        'name' => 'booking.list',
        'guard_name' => 'web',
        'group_name' => 'Booking',
      ],
      [
        'id' => '12',
        'name' => 'booking.add',
        'guard_name' => 'web',
        'group_name' => 'Booking',
      ],
      [
        'id' => '13',
        'name' => 'room.list.menu',
        'guard_name' => 'web',
        'group_name' => 'RoomList',
      ],
      [
        'id' => '14',
        'name' => 'room.list',
        'guard_name' => 'web',
        'group_name' => 'RoomList',
      ],
      [
        'id' => '15',
        'name' => 'setting.menu',
        'guard_name' => 'web',
        'group_name' => 'Setting',
      ],
      [
        'id' => '16',
        'name' => 'tesimonial.menu',
        'guard_name' => 'web',
        'group_name' => 'Tesimonial',
      ],
      [
        'id' => '17',
        'name' => 'tesimonial.all',
        'guard_name' => 'web',
        'group_name' => 'Tesimonial',
      ],
      [
        'id' => '18',
        'name' => 'tesimonial.add',
        'guard_name' => 'web',
        'group_name' => 'Tesimonial',
      ],
      [
        'id' => '19',
        'name' => 'tesimonial.edit',
        'guard_name' => 'web',
        'group_name' => 'Tesimonial',
      ],
      [
        'id' => '20',
        'name' => 'tesimonial.delete',
        'guard_name' => 'web',
        'group_name' => 'Tesimonial',
      ],
      [
        'id' => '21',
        'name' => 'blog.menu',
        'guard_name' => 'web',
        'group_name' => 'Blog',
      ],
      [
        'id' => '22',
        'name' => 'blog.category',
        'guard_name' => 'web',
        'group_name' => 'Blog',
      ],
      [
        'id' => '23',
        'name' => 'blog.post.list',
        'guard_name' => 'web',
        'group_name' => 'Blog',
      ],
      [
        'id' => '24',
        'name' => 'comment.menu',
        'guard_name' => 'web',
        'group_name' => 'Manage Comment',
      ],
      [
        'id' => '25',
        'name' => 'booking.report.menu',
        'guard_name' => 'web',
        'group_name' => 'Booking Report',
      ],
      [
        'id' => '26',
        'name' => 'gallery.menu',
        'guard_name' => 'web',
        'group_name' => 'Hotel Gallery',
      ],
      [
        'id' => '27',
        'name' => 'contact.message.menu',
        'guard_name' => 'web',
        'group_name' => 'Contact Message',
      ],
      [
        'id' => '28',
        'name' => 'role.permission.menu',
        'guard_name' => 'web',
        'group_name' => 'Role and Permission',
      ],
    ]);
  }
}
