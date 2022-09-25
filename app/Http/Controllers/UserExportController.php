<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class UserExportController extends Controller
{
    public function export()
    {
        return Excel::download(new Export, 'users.xlsx');
    }
}
