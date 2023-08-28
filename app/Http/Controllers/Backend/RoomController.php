<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Facility;

class RoomController extends Controller
{
  public function EditRoom($id)
  {
    $editData = Room::find($id);
    $basic_facility = Facility::where('rooms_id', $id)->get();

    return view(
      'backend.allroom.rooms.edit_rooms',
      compact('editData', 'basic_facility')
    );
  } //End Method 
}
