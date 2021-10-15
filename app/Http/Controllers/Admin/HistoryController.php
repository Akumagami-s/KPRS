<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Riwayat,Transaksi, Detailkpr};
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index($nrp)
    {

        $riwayat = Riwayat::where('nrp',$nrp)->first();
        $transaksi = Transaksi::where('nrp',$nrp)->where('status', '0001')->get();
        $user = Detailkpr::where('nrp', $nrp)->first();

        $ambil_tahun = DB::table('TrxBri')->where('nrp', $nrp)->where('status', '0001')
            ->select(DB::raw('YEAR(tanggal) as year'))->distinct()->orderByDesc('tanggal')->get();
        $years = $ambil_tahun->pluck('year');

        return view('admin.datapinjaman.history',compact('riwayat','transaksi', 'user'),[
            'transaksi' => DB::table('TrxBri')->where('nrp',$user->nrp)->orderBy('tanggal','ASC')->get(),
            'jumlah' => DB::table('kpr')->select('jml_angs')->where('nrp',$user->nrp)->first(),
            'riwayat' => $riwayat,
            'transaksi' => $transaksi,
            'years' => $years,
            'user' => $user,
            'kpr_id' => request('kpr_id')
        ]);
    }
    public function all($nrp)
    {
        return view('admin.datapinjaman.transaksi',[
            'transaksi' => DB::table('TrxBri')->where('nrp',$nrp)->whereNotNull('rekeningdebet')->orderBy('tanggal','ASC')->get(),
            'jumlah' => DB::table('kpr')->select('jml_angs')->where('nrp',$nrp)->first(),
            'text' => 'Bukti Angsuran Massdebet BRI KPR Swakelola TWP AD Seluruhnya'
        ]);
    }
    public function success($nrp)
    {
        return view('admin.datapinjaman.transaksi',[
            'transaksi' => DB::table('TrxBri')->where('nrp',$nrp)->where('status','0001')->whereNotNull('rekeningdebet')->orderBy('tanggal','ASC')->get(),
            'jumlah' => DB::table('kpr')->select('jml_angs')->where('nrp',$nrp)->first(),
            'text' => 'Bukti Angsuran Massdebet BRI KPR Swakelola TWP AD Yang Sukses'
        ]);
    }
    public function decline($nrp)
    {
        return view('admin.datapinjaman.transaksi',[
            'transaksi' => DB::table('TrxBri')->where('nrp',$nrp)->where('status','!=','0001')->orderBy('tanggal','ASC')->get(),
            'jumlah' => DB::table('kpr')->select('jml_angs')->where('nrp',$nrp)->first(),
            'text' => 'Bukti Angsuran Massdebet BRI KPR Swakelola TWP AD saldo tidak Cukup'
        ]);
    }

}
