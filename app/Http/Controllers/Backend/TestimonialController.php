<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InterventionImage;
use Carbon\Carbon;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
  public function AllTestimonial()
  {
    $testimonial = Testimonial::latest()->get();

    return view(
      'backend.tesimonial.all_tesimonial',
      compact('testimonial')
    );
  } // End Method 

  public function AddTestimonial()
  {
    return view('backend.tesimonial.add_testimonial');
  } // End Method 

  public function StoreTestimonial(Request $request)
  {
    $image = $request->file('image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(50, 50)->save('storage/upload/testimonial/' . $name_gen);
    $save_url = 'storage/upload/testimonial/' . $name_gen;

    Testimonial::insert([

      'name' => $request->name,
      'city' => $request->city,
      'message' => $request->message,
      'image' => $save_url,
      'created_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Testimonial Data Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.testimonial')->with($notification);
  } // End Method   
}
