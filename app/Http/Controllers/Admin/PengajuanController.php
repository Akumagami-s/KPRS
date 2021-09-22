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
    public function index()
    {
        if (request()->ajax()) {
            $detail_kprs = DB::table('kpr')->where('status', 2);
            $datatables = DataTables::queryBuilder($detail_kprs)
                ->editColumn('status', function($det){
                    return $det->status == null || $det->status == 0 || $det->status == 2
                        ? '<span class="badge badge-danger">BELUM APPROVAL</span>'
                        : '<span class="badge badge-success">SUDAH APPROVAL</span>';
                })->editColumn('nrp', function($det) {
                    return '<span class="badge badge-light">'. $det->nrp .'</span>';
                })->editColumn('pinjaman', function($det){
                    return "Rp." . number_format($det->pinjaman, 0,',','.');
                })->addColumn('aksi', function($det){
                    return '<button type="submit" onclick="confirmationUser('. "$det->id" .')" class="btn btn-success btn-sm">Approval <i class="fa fa-check"></i></button>
                    <form action="'. route('admin.pengajuan.confirmation', $det->id) .'" method="POST" id="ConfirmationUser'. $det->id .'">
                        '.csrf_field().'
                        '.method_field('patch').'
                    </form>';
                })
                ->rawColumns(['status', 'nrp', 'pinjaman', 'aksi'])
                ->toJson();

            return $datatables;
        }

        return view('admin.pengajuan.index');
    }

    public function confirmation($id)
    {
        $kpr = Detailkpr::find($id);
        $kpr->update([
            'status' => 1,
            'tmt_angsuran' => Carbon::now()->format('Y-m-d')
        ]);
        Alert::success('Informasi Pesan', 'Pengajuan berhasil di konfirmasi');
        return back();
    }
}
