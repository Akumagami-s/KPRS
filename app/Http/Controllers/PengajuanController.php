<?php

namespace App\Http\Controllers;

use App\Detailkpr;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{

    // public function index()
    // {
    //     return view('pengajuan.index');
    // }

    public function confirmation(Request $request)
    {

        foreach ($request->pengajuans_ids as $key => $value) {
            $kpr = Detailkpr::find($value);
        $kpr->update([
            'status' => 3,
            'tmt_angsuran' => Carbon::now()->format('Y-m-d')
        ]);
        }

       return response()->json(['mesage'=>'berhasil di approve'], 200);
    }
}
