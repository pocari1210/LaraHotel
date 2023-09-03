<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
  public function Checkout()
  {
    return view('frontend.checkout.checkout');
  } // End Method 

  public function BookingStore(Request $request)
  {

    /**********************************
     * ★バリデーション★
     * 
     * requiredで入力項目を必須にしている
     ***************************************/

    $validateData = $request->validate([
      'check_in' => 'required',
      'check_out' => 'required',
      'persion' => 'required',
      'number_of_rooms' => 'required',

    ]);

    /************************************************************
     * ★available_roomよりnumber_of_roomsが大きいときの処理★
     * 
     * toastrでエラーを表示させ、
     * book_dateのSessionを削除している
     * 
     * Session::forgetでセッションを削除
     **********************************************************/

    if ($request->available_room < $request->number_of_rooms) {

      $notification = array(
        'message' => 'Something want to wrong!',
        'alert-type' => 'error'
      );
      return redirect()->back()->with($notification);
    }

    Session::forget('book_date');

    /************************************************************
     * ★array()で関数でインデックス配列を作成★
     * 
     * array()で初期化した配列を$dataとし、
     * \frontend\room\search_room_details.blade.phpのformから
     * 送られてきた情報をインデックス配列に保存している
     **********************************************************/

    $data = array();
    $data['number_of_rooms'] = $request->number_of_rooms;
    $data['available_room'] = $request->available_room;
    $data['persion'] = $request->persion;
    $data['check_in'] = date('Y-m-d', strtotime($request->check_in));
    $data['check_out'] = date('Y-m-d', strtotime($request->check_out));
    $data['room_id'] = $request->room_id;

    // セッションに'book_date'(key) : $data(value)を保存

    Session::put('book_date', $data);

    return redirect()->route('checkout');
  } // End Method 
}
