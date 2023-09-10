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
}
