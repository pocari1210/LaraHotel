<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InterventionImage;
use Carbon\Carbon;
use App\Models\Gallery;

class GalleryController extends Controller
{
  public function AllGallery()
  {

    $gallery = Gallery::latest()->get();

    return view(
      'backend.gallery.all_gallery',
      compact('gallery')
    );
  } // End Method 

  public function AddGallery()
  {
    return view('backend.gallery.add_gallery');
  } // End Method 

  public function StoreGallery(Request $request)
  {

    $images = $request->file('photo_name');

    foreach ($images as $img) {
      $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
      InterventionImage::make($img)->resize(550, 550)->save('storage/upload/gallery/' . $name_gen);
      $save_url = 'storage/upload/gallery/' . $name_gen;

      Gallery::insert([
        'photo_name' => $save_url,
        'created_at' => Carbon::now(),
      ]);
    } //  end foreach 

    $notification = array(
      'message' => 'Gallery Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.gallery')->with($notification);
  } // End Method 

  public function EditGallery($id)
  {

    $gallery = Gallery::find($id);
    return view('backend.gallery.edit_gallery', compact('gallery'));
  } // End Method 

  public function UpdateGallery(Request $request)
  {

    $gal_id = $request->id;
    $img = $request->file('photo_name');

    $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
    InterventionImage::make($img)->resize(550, 550)->save('storage/upload/gallery/' . $name_gen);
    $save_url = 'storage/upload/gallery/' . $name_gen;

    Gallery::find($gal_id)->update([
      'photo_name' => $save_url,
    ]);

    $notification = array(
      'message' => 'Gallery Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.gallery')->with($notification);
  } // End Method 

  public function DeleteGallery($id)
  {

    $item = Gallery::findOrFail($id);

    $img = $item->photo_name;
    unlink($img);

    Gallery::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Gallery Image Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  }   // End Method 

  public function DeleteGalleryMultiple(Request $request)
  {

    $selectedItems = $request->input('selectedItem', []);

    foreach ($selectedItems as $itemId) {
      $item = Gallery::find($itemId);
      $img = $item->photo_name;
      unlink($img);
      $item->delete();
    }

    $notification = array(
      'message' => 'Selected Image Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 

  public function ShowGallery()
  {
    $gallery = Gallery::latest()->get();

    return view(
      'frontend.gallery.show_gallery',
      compact('gallery')
    );
  } // End Method
}
