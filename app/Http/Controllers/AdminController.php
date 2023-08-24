<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

  // ★Admin権限のLoginのコントローラー★
  public function AdminLogin()
  {
    return view('admin.admin_login');
  } // End Mehtod 

  public function AdminDashboard()
  {
    return view('admin.admin_dashboard');
  } // End Method 

  public function AdminLogout(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
  }
}
