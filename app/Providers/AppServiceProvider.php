<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SmtpSetting;
use Config;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {

    /********************************************************
     * 
     * ★\Schema::hasTable('テーブル名')★
     * smtp_settingsテーブルを指定し、SMTP設定を行う
     * 
     ***********************************************************/

    if (\Schema::hasTable('smtp_settings')) {
      $smtpsetting = SmtpSetting::first();

      if ($smtpsetting) {
        $data = [
          'driver' => $smtpsetting->mailer,
          'host' => $smtpsetting->host,
          'port' => $smtpsetting->port,
          'username' => $smtpsetting->username,
          'password' => $smtpsetting->password,
          'encryption' => $smtpsetting->encryption,
          'from' => [
            'address' => $smtpsetting->from_address,
            'name' => 'LaraHotel'
          ]
        ];
        Config::set('mail', $data);
      }
    } // end if
  }
}
