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
}
