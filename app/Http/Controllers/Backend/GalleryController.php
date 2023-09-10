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
}
