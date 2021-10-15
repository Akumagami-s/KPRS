<?php

namespace App\Http\Controllers\Admin;

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

    public function confirmation($id)
    {
        $kpr = Detailkpr::find($id);
        $kpr->update([
            'status' => 3,
            'tmt_angsuran' => Carbon::now()->format('Y-m-d')
        ]);
        Alert::success('Informasi Pesan', 'Pengajuan berhasil di konfirmasi');
        return back();
    }
}
 