<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SettingController extends Controller
{
  public function SiteSetting()
  {
    $site = SiteSetting::find(1);

    return view(
      'backend.site.site_update',
      compact('site')
    );
  } // End Method 
}
