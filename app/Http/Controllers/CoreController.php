<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Bulk;
use App\Testbulk;

use Illuminate\Support\Facades\DB;

class CoreController extends Controller
{

    public function bulk_upload(Request $request)
    {
        return view('bulk_upload');
    }

    public function store_bulk(Request $request)
    {
        // $file = $request->file('file');
        $file =file($request->file->GetRealPath());
        // dd(request()->file('file')->store('test_bulk'));
        $data=Excel::import(new Bulk, request()->file('file')->store('test_bulk'));
        dd($data);
        // return back();
        //  dd('ada');
        // $import = new Bulk();
        // $import->import($file);
        // $data = Excel::import(new Bulk, $file);

        // foreach ($import->failures() as $failure) {
        //         dump("row ". $failure->row()." have error with error is ".$failure->errors()[0]);
        // }






    }


}
