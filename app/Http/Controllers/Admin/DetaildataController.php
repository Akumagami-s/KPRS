<?php

namespace App\Http\Controllers\Admin;

use App\Detailkpr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Pinjaman;
use PDF;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Exports\DetailkprExport;
use App\Exports\RekapbulananExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
class DetaildataController extends Controller
{

    public function refresh_saldo()
    {
        $ambil_tahun = DB::table('kpr')->select(DB::raw('YEAR(tmt_angsuran) as year'))->distinct()->orderBy('tmt_angsuran')->get();
        $years = $ambil_tahun->pluck('year');
        return view('admin.detaildata.refreshsaldo.index', [
            'years' => $years
        ]);

    }

    public function refresh_piutang()
    {
        $ambil_tahun = DB::table('kpr')->select(DB::raw('YEAR(tmt_angsuran) as year'))->distinct()->orderBy('tmt_angsuran')->get();
        $years = $ambil_tahun->pluck('year');
        return view('admin.detaildata.refreshpiutang.index', [
            'years' => $years
        ]);

    }

    public function getAngsuranKe()
    {
        $pinjams = Detailkpr::orderBy('id', 'ASC')->paginate(40);
        return view('admin.detaildata.angsuranke.index', compact('pinjams'));
    }

    public function getangsuran(Request $request)
    {
        $cari = $request->cari;
        $pinjams = Detailkpr::where('id', 'LIKE', "%" . $cari . "%")->get();
        return view('admin.detaildata.angsuranke.index', compact('pinjams'));
    }
    public function getPokok()
    {
        return view('admin.detaildata.pokok.index');
    }
    public function getBunga()
    {
        return view('admin.detaildata.bunga.index');
    }
    public function getBesarAngsuran()
    {
        return view('admin.detaildata.besarangsuran.index');
    }
    public function getSisaAngsuran()
    {
        return view('admin.detaildata.sisaangsuran.index');
    }
    public function getindex($approve)
    {
        if ($approve == 'approve') {
            return view('admin.datapinjaman.approve.index');
        } else if($approve == 'pending') {
            return view('admin.datapinjaman.pending.index');
        } else if($approve == 'btn') {
            return view('admin.datapinjaman.btn.index');
        } else if($approve == 'debitur') {
            return view('admin.datapinjaman.debitur.index');
        } else if($approve == 'belomapprove') {
            return view('admin.datapinjaman.belomapprove.index');
        } else if($approve == 'lunas') {
            return view('admin.datapinjaman.lunas.index');
        } else if($approve == 'meninggal') {
            return view('admin.datapinjaman.meninggal.index');
        } else if($approve == 'outstanding') {
            return view('admin.datapinjaman.outstanding.index');
        } else if($approve == 'rekapbulanan') {
            return view('admin.datapinjaman.rekapbulanan.index');
        } else if($approve == 'penerimaan') {
            return view('admin.datapinjaman.penerimaan.index');
        } else if($approve == 'tunggakan') {
            return view('admin.datapinjaman.tunggakan.index');
        } else if($approve == 'piutang') {
            return view('admin.datapinjaman.piutang.index');
        } else if($approve == 'history') {
            return view('admin.datapinjaman.history.index');
        } else if($approve == 'carirekap') {
            return view('admin.datapinjaman.carirekap.index');
        } else if($approve == 'RekapBulanan') {
            return route('/RekapBulanan');
        } else {
            return view('admin.datapinjaman.btn.index');
        }
    }

    public function datatablesGetIndex($approve)
    {
        $pinjams = DB::table('kpr');
        if ($approve == 'approve') {
            $pinjams = $pinjams->where('status', 1)->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->addColumn('update', function($pinjam){
                    return '<a href="' . route('admin.detaildata.update.edit', $pinjam->id) . '" class="text-success">Update</a>';
                })
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' .$pinjam->nama . '</a>';
                })->editColumn('pangkat', function ($pinjam) {
                    return $pinjam->pangkat;
                })->editColumn('kesatuan', function ($pinjam) {
                    return $pinjam->kesatuan;
                })->editColumn('kotama', function ($pinjam) {
                    return $pinjam->kotama;
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        } else if ($approve == 'pending') {
            $pinjams = $pinjams->where('status', 0)->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->addColumn('update', function($pinjam){
                    return '<a href="' . route('admin.detaildata.update.edit', $pinjam->id) . '" class="text-success">Update</a>';
                })
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' . $pinjam->nama . '</a>';
                })->editColumn('pangkat', function ($pinjam) {
                    return $pinjam->pangkat;
                })->editColumn('kesatuan', function ($pinjam) {
                    return $pinjam->kesatuan;
                })->editColumn('kotama', function ($pinjam) {
                    return $pinjam->kotama;
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        } else if ($approve == 'btn') {
            $pinjams = $pinjams->where('status', 3)->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->addColumn('update', function($pinjam){
                    return '<a href="' . route('admin.detaildata.update.edit', $pinjam->id) . '" class="text-success">Update</a>';
                })
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' . $pinjam->nama . '</a>';
                })->editColumn('pangkat', function ($pinjam) {
                    return $pinjam->pangkat;
                })->editColumn('kesatuan', function ($pinjam) {
                    return $pinjam->kesatuan;
                })->editColumn('kotama', function ($pinjam) {
                    return $pinjam->kotama;
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        } else if ($approve == 'debitur') {
            $pinjams = $pinjams->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->addColumn('update', function($pinjam){
                    return '<a href="' . route('admin.detaildata.update.edit', $pinjam->id) . '" class="text-success">Update</a>';
                })
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' . $pinjam->nama . '</a>';
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['update','nrp', 'nama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        } else if ($approve == 'belumapprove') {
            $pinjams = $pinjams->where('status', 2)->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->addColumn('update', function($pinjam){
                    return '<a href="' . route('admin.detaildata.update.edit', $pinjam->id) . '" class="text-success">Update</a>';
                })
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' . $pinjam->nama . '</a>';
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['update','nrp', 'nama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        } else if ($approve == 'lunas') {
            $pinjams = $pinjams->where('status', 4)->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->addColumn('update', function($pinjam){
                    return '<a href="' . route('admin.detaildata.update.edit', $pinjam->id) . '" class="text-success">Update</a>';
                })
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' . $pinjam->nama . '</a>';
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['update','nrp', 'nama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        } else if ($approve == 'meninggal') {
            $pinjams = $pinjams->where('status', 5)->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->addColumn('update', function($pinjam){
                    return '<a href="' . route('admin.detaildata.update.edit', $pinjam->id) . '" class="text-success">Update</a>';
                })
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' . $pinjam->nama . '</a>';
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['update','nrp', 'nama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        } else if ($approve == 'outstanding') {
            $pinjams = $pinjams->orderBy('id', 'ASC');

            $data = DataTables::queryBuilder($pinjams)
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('piutang_pokok', function ($pinjam) {
                    return  'Rp.'. number_format($pinjam->piutang_pokok, 0, ',', '.');
                })->editColumn('tunggakan_bunga', function ($pinjam) {
                    return 'Rp.'. number_format($pinjam->tunggakan_bunga, 0, ',', '.');
                })->editColumn('outstanding', function ($pinjam) {
                    return 'Rp.'. number_format($pinjam->tunggakan_bunga + $pinjam->piutang_pokok, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'piutang_pokok', 'tunggakan_bunga', 'outstanding'])
                ->toJson();
        } else if ($approve == 'rekapbulanan') {
            $pinjams = $pinjams->orderBy('tmt_angsuran', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('piutang_pokok', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->piutang_pokok, 0, ',', '.');
                })->editColumn('piutang_bunga', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->piutang_bunga, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->editColumn('tunggakan_pokok', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->tunggakan_pokok, 0, ',', '.');
                })->editColumn('bunga', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->bunga, 0, ',', '.');
                })->editColumn('pokok', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->pokok, 0, ',', '.');
                })->editColumn('inisial_bunga', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->inisial_bunga, 0, ',', '.');
                })->editColumn('inisial_pokok', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->inisial_pokok, 0, ',', '.');
                })->editColumn('sisa_pinjaman_pokok', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->sisa_pinjaman_pokok, 0, ',', '.');
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('tunggakan_bunga', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->tunggakan_bunga, 0, ',', '.');
                })->editColumn('outstanding', function ($pinjam) {
                    return 'Rp.'. number_format($pinjam->tunggakan_bunga + $pinjam->piutang_pokok, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'piutang_pokok', 'tunggakan_bunga', 'piutang_bunga', 'pinjaman', 'jml_angs', 'jml_tunggakan', 'pokok', 'bunga', 'tunggakan_pokok', 'inisial_pokok', 'inisial_bunga', 'sisa_pinjaman_pokok', 'outstanding'])
                ->toJson();
        } else if ($approve == 'penerimaan') {
                $pinjams = $pinjams->orderBy('id', 'ASC');
                $data = DataTables::queryBuilder($pinjams)
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('pokok', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->pokok, 0, ',', '.');
                })->editColumn('bunga', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->bunga, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'pokok', 'bunga'])
                    ->toJson();
                } else if ($approve == 'tunggakan') {
                        $pinjams = $pinjams->orderBy('id', 'ASC');
                        $data = DataTables::queryBuilder($pinjams)
                        ->editColumn('nrp', function ($pinjam) {
                            return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                        })->editColumn('tunggakan_pokok', function ($pinjam) {
                            return "Rp. " . number_format($pinjam->tunggakan_pokok, 0, ',', '.');
                        })->editColumn('tunggakan_bunga', function ($pinjam) {
                            return "Rp. " . number_format($pinjam->tunggakan_bunga, 0, ',', '.');
                        })->editColumn('jml_tunggakan', function ($pinjam) {
                            return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                        })->rawColumns(['nrp', 'nama', 'tunggakan_pokok', 'tunggakan_bunga', 'jml_tunggakan'])
                            ->toJson();
                } else if ($approve == 'piutang') {
                        $pinjams = $pinjams->orderBy('id', 'ASC');
                        $data = DataTables::queryBuilder($pinjams)
                        ->editColumn('nrp', function ($pinjam) {
                            return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                        })->editColumn('piutang_pokok', function ($pinjam) {
                            return "Rp. " . number_format($pinjam->tunggakan_pokok, 0, ',', '.');
                        })->editColumn('piutang_bunga', function ($pinjam) {
                            return "Rp. " . number_format($pinjam->tunggakan_bunga, 0, ',', '.');
                        })->rawColumns(['nrp', 'nama', 'piutang_pokok', 'piutang_bunga'])
                            ->toJson();
                } else if ($approve == 'history') {
            if (request()->ajax()) {
                $status = request('status');
            } else {
                $status = 4;
            }
            $pinjams = $pinjams->where('status', $status)->orderBy('id', 'ASC');
            $data = DataTables::queryBuilder($pinjams)
                ->editColumn('nrp', function ($pinjam) {
                    return '<span class="badge badge-light">' . $pinjam->nrp . '</span>';
                })->editColumn('nama', function ($pinjam) {
                    return '<a href="' . route('admin.detaildata.show', $pinjam->id) . '" class="text-primary">' . $pinjam->nama . '</a>';
                })->editColumn('pinjaman', function ($pinjam) {
                    return "IDR. " . number_format($pinjam->pinjaman, 0, ',', '.');
                })->editColumn('jml_angs', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_angs, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($pinjam) {
                    return "Rp. " . number_format($pinjam->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
                ->toJson();
        }

        return $data;
    }

    public function carirekap(Request $request)
    {


    }



    public function statusupdate($id)
    {
        $pinjam = Pinjaman::findOrFail($id);
        $pinjam->update([
            'status' => 1
        ]);
        return back();
    }
    public function statusdecline($id)
    {
        $pinjam = Pinjaman::findOrFail($id);
        $pinjam->update([
            'status' => 0
        ]);
        return back();
    }



    public function lunas($nrp)
    {
        $pinjam = Pinjaman::findOrFail($id);
        $pinjam->update([
            'status' => 1
        ]);
        return back();
    }

    public function meninggal($nrp)
    {
        $pinjam = Pinjaman::findOrFail($id);
        $pinjam->update([
            'status' => 1
        ]);
        return back();
    }

    public function cari(Request $request)
    {
        $id = $request->cari;
        $pinjams = Detailkpr::where('nrp', 'like', "%" . $id . "%")->get();
        return view('admin.detaildata.angsuranke.index', compact('pinjams'));
    }

    public function show($id)
    {

        $kpr = Detailkpr::find($id);

        $massdebet = 0;
        $manual = 0;
        $dateceks = 0;
        $date = 0 ;
        $imam = DB::table('TrxBri')->where('nrp', $kpr->nrp)->where('status', '0001')->whereNotNull('rekeningdebet')->orderBy('tanggal','ASC')->get();


        foreach($imam as $item){
            $date = date("m Y", strtotime($item->tanggal));
            if ($date != $dateceks ) {
                if(!empty($item->kodecabang)){
                    $massdebet++;
                }
                if(empty($item->kodecabang)){
                    $manual++;
                }
            }
        $dateceks  = date("m Y", strtotime($item->tanggal));
       }



    // Mulai kodingan Reksa
    $bln = (int)date('m', strtotime($kpr->tmt_angsuran));

    $besar_pinjaman = $kpr->pinjaman;
    $bunga = 6/100;
    $jangka = $kpr->jk_waktu;
    $tahun = $jangka/12;



    // $besar_pinjaman = $kpr->pinjaman;
    // $bunga = 6;
    // $jangka = $kpr->jk_waktu;
    // $bungapersen = $bunga / 100;
    // $tahun = $jangka / 12;


    $c = pow((1 + $bunga), $tahun);
    $d = $c - 1;
    $fax = ($bunga * $c) / $d;

    //tergantung mau dibuletinnya gimana
    $anunitas = round($fax, 6);
    $besar_angsur = ($besar_pinjaman * $anunitas) / 12;
    $besar_angsuran = round($besar_angsur, -3) + 1000;
    // angsuran bunga
    $bunga_all = [0 => null];
    // angsuran pokok
    $pokok_all = [0 => null];
    // angsuran pinjaman
    $pinjaman_all = [0 => intval($besar_pinjaman)];
    $date = date_create($kpr->tmt_angsuran);

    $array5 = [0 => date_format($date,"Y-m-d")];


     $angsuran_bunga = $besar_pinjaman * $bunga / 12;
    $angsuran_pokok = $besar_angsuran - $angsuran_bunga;


    $ang = $bln;
    for ($i = 1; $i < $jangka + 1; $i++) {
    if($bln == 13){
          $ang_bunga = $besar_pinjaman * $bunga / 12;
            $angsuran_bunga = round($ang_bunga, 2);
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
            $bln = 1;
        }
        $bunga_all[] = $angsuran_bunga;
        $pokok_all[] = $angsuran_pokok;
        $besar_pinjaman -= $pokok_all[$i];
        $pinjaman_all[] = $besar_pinjaman;
        $bln++;
    }


    $saldo_bunga_total = array_sum(array_slice($bunga_all, 0, $kpr->angsuran_masuk+1));
    $saldo_pokok_total = array_sum(array_slice($pokok_all, 0, $kpr->angsuran_masuk+1));

    $utang_bunga_total = array_sum(array_slice($bunga_all, $kpr->angsuran_masuk+1, $jangka));
    $utang_pokok_total = array_sum(array_slice($pokok_all, $kpr->angsuran_masuk+1, $jangka));

    // end




    // codingan orang hal 1



        $array_all = [
            'bunga' => $bunga_all,
            'pokok' => $pokok_all,
            'pinjaman' => $pinjaman_all,
            'besar_angsuran' => $besar_angsuran,
            'tanggal' => $array5
        ];

        return view('admin.datapinjaman.approve.show',[
            'transaksi' => DB::table('TrxBri')->where('nrp',$kpr->nrp)->orderBy('tanggal','ASC')->get(),
            'jumlah' => DB::table('kpr')->select('jml_angs')->where('nrp',$kpr->nrp)->first(),
            'angsuran_masuk' => $kpr->angsuran_masuk,
            'jangka' => $jangka,
            'besar_angsuran' => $besar_angsuran,
            'kpr' => $kpr,
            'nrp' => $kpr->nrp,
            'all' => $array_all,
            'total_bunga_saldo' => $saldo_bunga_total,
            'total_pokok_saldo' => $saldo_pokok_total,
            'total_bunga_piutang' => $kpr->piutang_bunga,
            'total_pokok_piutang' => $kpr->piutang_pokok,
            'tunggakan_bunga' => $kpr->tunggakan_bunga,
            'massdebat'=> $massdebet,
            'manual' => $manual,
        ]);

    }

     public function refresh($id)
    {
        $kpr = Detailkpr::find($id);
        $besar_pinjaman = $kpr->pinjaman;
        $bunga = 6;
        $jangka = $kpr->jk_waktu;

        $bungapersen = $bunga / 100;
        $tahun = $jangka / 12;

        $c = pow((1 + $bungapersen), $tahun);
        $d = $c - 1;
        $fax = ($bungapersen * $c) / $d;
        $anuitas = round($fax, 6);

        $besar_angsur = ($besar_pinjaman * $anuitas) / 12;

        $besar_angsurans = round($besar_angsur, -3)+1000;
        if ($besar_angsurans != $kpr->jml_angs) {
            $besar_angsuran = round($besar_angsur, -3) + 1000;
        }else {
            $besar_angsuran = round($besar_angsur, -3);
        }

        // if (substr($a, -2) >= 1) {
        // }
        // dd($besar_angsuran);
        //angsuran bunga = pinjaman pokok * bungapersen/ 12-24-36-48-60-72-84-96
        // $besar_angsuran = besarAngsuran($besar_pinjaman,$getAnuitas);
        $array1 = [0 => null];
        $array2 = [0 => null];
        $array3 = [0 => intval($besar_pinjaman)];
        $array4 = [0 => 0];

        $no = 1;
        $b = 1;
        $angsuran_bunga = $besar_pinjaman * $bungapersen / 12;
        $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

        $bulan = (int)date('m', strtotime($kpr->tmt_angsuran));

        $sisa_angsuran = $kpr->jk_waktu - $kpr->angsuran_masuk - $kpr->tunggakan;
        // dd($sisa_angsuran);
        for ($i = $bulan; $i < $jangka + $bulan; $i++) {
                if ($i == 13 ||$no == 13) {
                    // echo $i." ";
                    $ang_bunga = $besar_pinjaman * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }
            $no++;
            array_push($array1, $angsuran_bunga);
            array_push($array2, $angsuran_pokok);
            array_push($array4, $besar_angsuran);
             $besar_pinjaman -= $array2[$b];
             $b++;
            array_push($array3, $besar_pinjaman);
        }

        // for ($z = $bulan; $z < $jangka+1; $z++) {
        //     if ($z == 13 ||$no == 13) {
        //         $ang_bunga_utang = $besar_pinjaman * $bungapersen / 12;
        //         $angsuran_bunga_utang = round($ang_bunga_utang);
        //         $angsuran_pokoks_utang = $besar_angsuran - $angsuran_bunga;
        //         $angsuran_pokok_utang = round($angsuran_pokoks_utang);
        //         $no = 1;
        //     }

        //     $no++;
        //         array_push($array_utang1, $angsuran_bunga_utang);
        //         array_push($array_utang2, $angsuran_pokok_utang);
        //         array_push($array_utang4, $besar_angsuran);
        //     $besar_pinjaman -= $array2[$b];
        //     $b++;
        //     array_push($array3, $besar_pinjaman);

        //     echo $z . "." . $angsuran_bunga_utang . "<br>";
        // }
        // dd();
        $saldo_bunga_total = array_sum(array_slice($array1, 0, $kpr->angsuran_masuk+1));
        $saldo_pokok_total = array_sum(array_slice($array2, 0, $kpr->angsuran_masuk+1));

        $utang_bunga_total = array_sum(array_slice($array1, $kpr->angsuran_masuk+1, $jangka));
        $utang_pokok_total = array_sum(array_slice($array2, $kpr->angsuran_masuk+1, $jangka));

        // dd($utang_pokok_total);
        // echo $i;

        //TOTAL BUNGA POKOK YANG DULU (SALAH)
        // $total_bunga = array_sum($array1);
        // $total_pokok = round(array_sum($array2));

        // dd($utang_bunga_total);

        // BIKIN FUNGSI UPDATE DISINI
        Detailkpr::where('id',$id)->update([
            'piutang_pokok' => $utang_pokok_total,
            'piutang_bunga' => $utang_bunga_total
        ]);
        // echo 'besar_angsuran '.$besar_angsuran;
        // $array_all = [
        //     'bunga' => $array1,
        //     'pokok' => $array2,
        //     'pinjaman' => $array3,
        //     'besar_angsuran' => $array4
        // ];
        return redirect()->back();
    }
    public function approve_pdf($id)
    {

        $kpr = Detailkpr::find($id);


        $besar_pinjaman = $kpr->pinjaman;
        $bunga = 6;
        $jangka = $kpr->jk_waktu;

        $manual = 0;
       $dateceks = 0 ;
       $massdebet = 0;
       $date = 0 ;
       $imam = DB::table('TrxBri')->where('nrp', $kpr->nrp)->where('status', '0001')->orderBy('tanggal','ASC')->get();
       foreach($imam as $item){
           $date = date("m Y", strtotime($item->tanggal));
           if ($date != $dateceks ) {
                if(!empty($item->kodecabang)){
                    $massdebet++;
                }
                if(empty($item->kodecabang)){
                    $manual++;
                }
            }
         $dateceks  = date("m Y", strtotime($item->tanggal));
       }
        $bungapersen = $bunga / 100;
        $tahun = $jangka / 12;

        $c = pow((1 + $bungapersen), $tahun);
        $d = $c - 1;
        $fax = ($bungapersen * $c) / $d;
        $anuitas = round($fax, 6);

        $besar_angsur = ($besar_pinjaman * $anuitas) / 12;

        $besar_angsuran = round($besar_angsur, -3) ;
        if ($besar_angsuran != $kpr->jml_angs) {
            $besar_angsuran = round($besar_angsur, -3) + 1000;
        }
        // if (substr($a, -2) >= 1) {
        // }
        // dd($besar_angsuran);
        //angsuran bunga = pinjaman pokok * bungapersen/ 12-24-36-48-60-72-84-96
        // $besar_angsuran = besarAngsuran($besar_pinjaman,$getAnuitas);
        $array1 = [0 => null];
        $array2 = [0 => null];
        $array3 = [0 => intval($besar_pinjaman)];
        $array4 = [0 => 0];

        $array_utang1 = [0 => null];
        $array_utang2 = [0 => null];
        $array_utang3 = [0 => intval($besar_pinjaman)];
        $array_utang4 = [0 => 0];

        $no = 1;
        $b = 1;
        $angsuran_bunga = $besar_pinjaman * $bungapersen / 12;
        $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

        $angsuran_bunga_utang = $besar_pinjaman * $bungapersen / 12;
        $angsuran_pokok_utang = $besar_angsuran - $angsuran_bunga;

        $bulan = (int)date('m', strtotime($kpr->tmt_angsuran));

        $sisa_angsuran = $kpr->jk_waktu - $kpr->angsuran_masuk - $kpr->tunggakan;
        // dd($sisa_angsuran);
        for ($i = $bulan; $i < $kpr->angsuran_masuk + $bulan; $i++) {

                if ($i == 13 ||$no == 13) {
                    // echo $i." ";
                    $ang_bunga = $besar_pinjaman * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }

            $no++;
            array_push($array1, $angsuran_bunga);
            array_push($array2, $angsuran_pokok);
            array_push($array4, $besar_angsuran);

             $besar_pinjaman -= $array2[$b];
             $b++;
            array_push($array3, $besar_pinjaman);
        }

        $saldo_bunga_total = array_sum(array_slice($array1, 0, $kpr->angsuran_masuk+1));
        $saldo_pokok_total = array_sum(array_slice($array2, 0, $kpr->angsuran_masuk+1));

        $utang_bunga_total = array_sum(array_slice($array1, $kpr->angsuran_masuk+1, $jangka));
        $utang_pokok_total = array_sum(array_slice($array2, $kpr->angsuran_masuk+1, $jangka));

        $array_all = [
            'bunga' => $array1,
            'pokok' => $array2,
            'pinjaman' => $array3,
            'besar_angsuran' => $array4
        ];
        // echo 'besar_angsuran '.$besar_angsuran;
        $array_all = [
            'bunga' => $array1,
            'pokok' => $array2,
            'pinjaman' => $array3,
            'besar_angsuran' => $array4
        ];
        $pdf = PDF::loadview('admin.datapinjaman.pdf', [
            'transaksi' => DB::table('TrxBri')->where('nrp',$kpr->nrp)->orderBy('tanggal','ASC')->get(),
            'jumlah' => DB::table('kpr')->select('jml_angs')->where('nrp',$kpr->nrp)->first(),
            'angsuran_masuk' => $kpr->angsuran_masuk,
            'jangka' => $jangka,
            'besar_angsuran' => $besar_angsuran,
            'kpr' => $kpr,
            'nrp' => $kpr->nrp,
            'all' => $array_all,
            'total_bunga_saldo' => $saldo_bunga_total,
            'total_pokok_saldo' => $saldo_pokok_total,
            'total_bunga_piutang' => $kpr->piutang_bunga,
            'total_pokok_piutang' => $kpr->piutang_pokok,
            'tanggal' => Carbon::now(),
            'massdebat'=> $massdebet
        ]);
        return $pdf->stream();
    }

    public function search_data_kpr()
    {
        $query = request('query');
        $pinjam = Detailkpr::where('status', 1)->where("nama", "like", "%$query%")
            ->orWhere("nrp", "like", "%$query%")
            ->latest()->paginate(20);
        return view('admin.datapinjaman.approve.index', [
            'pinjams' => $pinjam
        ]);
    }

    public function search_data_manual()
    {
        $query = request('query');
        $pinjam = Detailkpr::where('status', 0)->where("nama", "like", "%$query%")
            ->orWhere("nrp", "like", "%$query%")
            ->latest()->paginate(20);
        return view('admin.datapinjaman.pending.index', [
            'pinjams' => $pinjam
        ]);
    }
    public function DetailkprExportExcel()
    {
        ob_end_clean();
        ob_start();
        $current = Carbon::now()->toDateTimeString();
        return Excel::download(new DetailkprExport(), 'Detail kpr Global '.$current.' Export.xlsx');
    }
    public function RekapbulananExportExcel($bulan, $tahun)
    {
        ob_end_clean();
        ob_start();
        // $current = Carbon::now()->toDateTimeString();
        return Excel::download(new RekapbulananExport($bulan, $tahun),'REKAP BULALAN KPR ' . ' Export.xlsx');

    }
}
