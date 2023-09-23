<?php

namespace App\Exports;

// use App\Models\User;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;

class PermissionExport implements FromCollection
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    // return User::all();

    return Permission::select('name', 'group_name')->get();
  }
}
