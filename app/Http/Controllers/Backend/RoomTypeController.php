<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention;
use Carbon\Carbon;
use App\Models\RoomType;
use App\Models\BookArea;

class RoomTypeController extends Controller
{
  public function RoomTypeList()
  {
    $allData = RoomType::orderBy('id', 'desc')->get();

    return view(
      'backend.allroom.roomtype.view_roomtype',
      compact('allData')
    );
  } // End Method 

  public function AddRoomType()
  {
    return view('backend.allroom.roomtype.add_roomtype');
  } // End Method 

  public function RoomTypeStore(Request $request)
  {
    RoomType::insert([
      'name' => $request->name,
      'created_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'RoomType Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('room.type.list')->with($notification);
  } // End Method 
}
