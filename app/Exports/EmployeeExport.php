<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $name = isset($_REQUEST['name']) && !empty($_REQUEST['name']) ? $_REQUEST['name'] : NULL;
        $phone = isset($_REQUEST['phone_no']) && !empty($_REQUEST['phone_no']) ? $_REQUEST['phone_no'] : NULL;

        $users = User::orderBy('id', 'DESC');

        if ($name != null) {

            $users->where('name', 'LIKE', '%' . $name . '%')->get();
        }
        if ($phone != null) {

            $users->where('phone', $phone)->get();
        }

        if ($name == null &&  $phone == null) {
            $users->get();
        }
        $users = $users->get();

        return view('website.export.employee', compact('users'));
    }
}
