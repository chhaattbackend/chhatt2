<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new LeadsExport, 'leads.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new LeadsImport,request()->file('file'));

        return redirect()->route('leads.index');
    }
}
