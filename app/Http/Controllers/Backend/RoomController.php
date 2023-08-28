<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InterventionImage;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;

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

  public function UpdateRoom(Request $request, $id)
  {

    $room  = Room::find($id);
    $room->roomtype_id = $room->roomtype_id;
    $room->total_adult = $request->total_adult;
    $room->total_child = $request->total_child;
    $room->room_capacity = $request->room_capacity;
    $room->price = $request->price;

    $room->size = $request->size;
    $room->view = $request->view;
    $room->bed_style = $request->bed_style;
    $room->discount = $request->discount;
    $room->short_desc = $request->short_desc;
    $room->description = $request->description;

    /// Update Single Image 
    if ($request->file('image')) {
      $image = $request->file('image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      InterventionImage::make($image)->resize(550, 850)->save('storage/upload/roomimg/' . $name_gen);
      $room['image'] = $name_gen;
    }

    $room->save();

    //// Update for Facility Table 

    if ($request->facility_name == NULL) {

      $notification = array(
        'message' => 'Sorry! Not Any Basic Facility Select',
        'alert-type' => 'error'
      );

      return redirect()->back()->with($notification);
    } else {
      Facility::where('rooms_id', $id)->delete();
      $facilities = Count($request->facility_name);
      for ($i = 0; $i < $facilities; $i++) {

        // オブジェクト(インスタンス)を新規作成
        $fcount = new Facility();

        // Roomテーブルのid情報を取得
        $fcount->rooms_id = $room->id;
        $fcount->facility_name = $request->facility_name[$i];
        $fcount->save();
      } // end for
    } // end else 

    //// Update Multi Image 

    if ($room->save()) {
      $files = $request->multi_img;
      if (!empty($files)) {

        // toArrayメソッドで配列に変換
        $subimage = MultiImage::where('rooms_id', $id)
          ->get()->toArray();

        MultiImage::where('rooms_id', $id)->delete();
      }
      if (!empty($files)) {
        foreach ($files as $file) {
          $imgName = date('YmdHi') . $file->getClientOriginalName();
          $file->move('storage/upload/roomimg/multi_img/', $imgName);

          // MultiImageテーブルのmulti_imgカラムに
          // $imgNameを代入
          $subimage['multi_img'] = $imgName;

          // オブジェクト(インスタンス)を新規作成
          $subimage = new MultiImage();

          // Roomテーブルのid情報を取得
          $subimage->rooms_id = $room->id;
          $subimage->multi_img = $imgName;
          $subimage->save();
        }
      }
    } // end if

    $notification = array(
      'message' => 'Room Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } //End Method 
}
