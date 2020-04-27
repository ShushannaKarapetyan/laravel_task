<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Routing\Redirector;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelController extends Controller
{
    /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return Redirector
     */
    public function import()
    {
        Excel::import(new UsersImport, 'storage/users.xlsx');

        return redirect('/');
    }
}
