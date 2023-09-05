<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomNumber;
use App\Models\RoomType;

class RoomListController extends Controller
{
  public function ViewRoomList()
  {

    /*************************************************
     * 
     * ★リレーション★
     * 
     * withメソッド:
     * app\Models\RoomNumber.phpで記述した
     * room_typeメソッドとlast_bookingメソッドを記述し、
     * リレーションしている。
     * 
     * last_booking.bookingのbookingは、
     * app\Models\BookingRoomList.phpで記述を行った
     * bookingメソッドを指し、Bookingモデルにアクセスを行い、
     * :(コロン)以降でカラムを指定している
     * 
     ************************************************/

    $room_number_list = RoomNumber::with([
      'room_type',
      'last_booking.booking:id,check_in,check_out,status,code,name,phone'
    ])->orderBy('room_type_id', 'asc')

      /****************************************************************
       * 
       * ★leftJoinメソッド(左外部結合)★
       * 
       * どちらかのテーブルにレコード(idなど)が紐づいていない場合でも
       * Nullで結果が返される。
       * 
       * 第一引数:対象のテーブル名を記述
       * 第二引数:第一引数で指定したテーブル名.カラム名で指定
       * 第三引数:リレーションを行うテーブル名.カラム名で指定
       * 
       ****************************************************************/

      ->leftJoin('room_types', 'room_types.id', 'room_numbers.room_type_id')
      ->leftJoin('booking_room_lists', 'booking_room_lists.room_number_id', 'room_numbers.id')
      ->leftJoin('bookings', 'bookings.id', 'booking_room_lists.booking_id')

      ->select(
        'room_numbers.*',
        'room_numbers.id as id',
        'room_types.name as name',
        'bookings.id as booking_id',
        'bookings.check_in',
        'bookings.check_out',
        'bookings.name as customer_name',
        'bookings.phone as customer_phone',
        'bookings.status as booking_status',
        'bookings.code as booking_no'
      )
      ->orderBy('room_types.id', 'asc')
      ->orderBy('bookings.id', 'desc')
      ->get();

    return view(
      'backend.allroom.roomlist.view_roomlist',
      compact('room_number_list')
    );
  } // End Method 

  public function AddRoomList()
  {

    $roomtype = RoomType::all();

    return view(
      'backend.allroom.roomlist.add_roomlist',
      compact('roomtype')
    );
  } // End Method
}
