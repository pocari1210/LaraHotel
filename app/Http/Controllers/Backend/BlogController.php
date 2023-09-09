<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use InterventionImage;
use Carbon\Carbon;

class BlogController extends Controller
{
  public function BlogCategory()
  {
    $category = BlogCategory::latest()->get();

    return view(
      'backend.category.blog_category',
      compact('category')
    );
  } // End Method 

  public function StoreBlogCategory(Request $request)
  {

    BlogCategory::insert([
      'category_name' => $request->category_name,
      'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
    ]);

    $notification = array(
      'message' => 'BlogCategory Added Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 

  public function EditBlogCategory($id)
  {
    $categories = BlogCategory::find($id);

    return response()->json($categories);
  } // End Method 

  public function UpdateBlogCategory(Request $request)
  {

    $cat_id = $request->cat_id;

    BlogCategory::find($cat_id)->update([
      'category_name' => $request->category_name,
      'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
    ]);

    $notification = array(
      'message' => 'BlogCategory Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 
}
