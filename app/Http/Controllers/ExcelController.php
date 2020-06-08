<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Imports\ZipCodesImport;
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

    public function importZipCodes()
    {
        Excel::import(new ZipCodesImport, 'storage/zip_codes.xls');

        return redirect('/');
    }
}
