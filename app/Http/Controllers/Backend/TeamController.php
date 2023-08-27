<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InterventionImage;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\BookArea;

class TeamController extends Controller
{
  public function AllTeam()
  {
    $team = Team::latest()->get();

    return view(
      'backend.team.all_team',
      compact('team')
    );
  } // End Method 

  public function AddTeam()
  {
    return view('backend.team.add_team');
  } // End Method 

  public function StoreTeam(Request $request)
  {
    $image = $request->file('image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(550, 670)->save('storage/upload/team/' . $name_gen);
    $save_url = 'storage/upload/team/' . $name_gen;

    Team::insert([

      'name' => $request->name,
      'postion' => $request->postion,
      'facebook' => $request->facebook,
      'image' => $save_url,
      'created_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Team Data Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.team')->with($notification);
  } // End Method 

  public function EditTeam($id)
  {
    $team = Team::findOrFail($id);

    return view(
      'backend.team.edit_team',
      compact('team')
    );
  } // End Method 

  public function UpdateTeam(Request $request)
  {
    $team_id = $request->id;

    // 画像の変更を含む場合の処理
    if ($request->file('image')) {

      $image = $request->file('image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      InterventionImage::make($image)->resize(550, 670)->save('storage/upload/team/' . $name_gen);
      $save_url = 'storage/upload/team/' . $name_gen;

      Team::findOrFail($team_id)->update([

        'name' => $request->name,
        'postion' => $request->postion,
        'facebook' => $request->facebook,
        'image' => $save_url,
        'created_at' => Carbon::now(),
      ]);

      $notification = array(
        'message' => 'Team Updated With Image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.team')->with($notification);

      // 画像の変更を含まない場合の処理
    } else {

      Team::findOrFail($team_id)->update([
        'name' => $request->name,
        'postion' => $request->postion,
        'facebook' => $request->facebook,
        'created_at' => Carbon::now(),
      ]);

      $notification = array(
        'message' => 'Team Updated Without Image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.team')->with($notification);
    } // End Eles 

  } // End Method  

  public function DeleteTeam($id)
  {
    $item = Team::findOrFail($id);
    $img = $item->image;
    unlink($img);

    Team::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Team Image Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  }   // End Method 

  //  ==================== Book Area All Methods =============

  public function BookArea()
  {
    $book = BookArea::find(1);

    return view(
      'backend.bookarea.book_area',
      compact('book')
    );
  }  // End Method   

  public function BookAreaUpdate(Request $request)
  {

    $book_id = $request->id;

    // 画像の変更を行う場合の処理
    if ($request->file('image')) {

      $image = $request->file('image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      InterventionImage::make($image)->resize(1000, 1000)->save('storage/upload/bookarea/' . $name_gen);
      $save_url = 'storage/upload/bookarea/' . $name_gen;

      BookArea::findOrFail($book_id)->update([

        'short_title' => $request->short_title,
        'main_title' => $request->main_title,
        'short_desc' => $request->short_desc,
        'link_url' => $request->link_url,
        'image' => $save_url,
      ]);

      $notification = array(
        'message' => 'Book Area Updated With Image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);

      // 画像の変更を含めない場合の処理
    } else {

      BookArea::findOrFail($book_id)->update([
        'short_title' => $request->short_title,
        'main_title' => $request->main_title,
        'short_desc' => $request->short_desc,
        'link_url' => $request->link_url,
      ]);

      $notification = array(
        'message' => 'Book Area Updated Without Image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);
    } // End Eles 
  } // End Method 
}
