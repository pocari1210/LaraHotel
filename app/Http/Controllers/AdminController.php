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

  // プロフィール情報更新のコントローラー
  public function AdminProfileStore(Request $request)
  {
    $id = Auth::user()->id;
    $data = User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->address = $request->address;

    if ($request->file('photo')) {
      $file = $request->file('photo');
      @unlink(public_path('storage/upload/admin_images/' . $data->photo));
      $filename = date('YmdHi') . $file->getClientOriginalName();
      $file->move(public_path('storage/upload/admin_images'), $filename);
      $data['photo'] = $filename;
    }
    $data->save();

    $notification = array(
      'message' => 'Admin Profile Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 

  public function AdminLogout(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
  }
}
