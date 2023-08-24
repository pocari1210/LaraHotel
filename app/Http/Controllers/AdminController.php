<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

  // ★プロフィールページ疎通のコントローラー★
  public function AdminProfile()
  {
    $id = Auth::user()->id;
    $profileData = User::find($id);

    return view(
      'admin.admin_profile_view',
      compact('profileData')
    );
  } // End Method 

  public function AdminLogout(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
  }
}
