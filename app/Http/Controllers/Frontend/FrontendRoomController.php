<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Room;
use App\Models\MultiImage;
use App\Models\Facility;

class FrontendRoomController extends Controller
{
  public function AllFrontendRoomList()
  {
    $rooms = Room::latest()->get();

    return view(
      'frontend.room.all_rooms',
      compact('rooms')
    );
  } // End Method 

  public function RoomDetailsPage($id)
  {
    $roomdetails = Room::find($id);
    $multiImage = MultiImage::where('rooms_id', $id)->get();
    $facility = Facility::where('rooms_id', $id)->get();
    $otherRooms = Room::where('id', '!=', $id)
      ->orderBy('id', 'DESC')->limit(2)->get();

    return view(
      'frontend.room.room_details',
      compact('roomdetails', 'multiImage', 'facility', 'otherRooms')
    );
  } // End Method 

  public function BookingSeach(Request $request)
  {

    $request->flash();

    // 日付が同じ時だった時の処理
    if ($request->check_in == $request->check_out) {

      $notification = array(
        'message' => 'Something want to worng',
        'alert-type' => 'error'
      );

      return redirect()->back()->with($notification);
    }

    // ★dateメソッド★
    // 第1引数をフォーマット(string),
    // 第2引数をタイムスタンプ(int)で記述
    $sdate = date('Y-m-d', strtotime($request->check_in));
    $edate = date('Y-m-d', strtotime($request->check_out));

    // ★subDayメソッド★
    // $edateの日付を減算している
    $alldate = Carbon::create($edate)->subDay();
    $d_period = CarbonPeriod::create($sdate, $alldate);
  } // End Method 
}
