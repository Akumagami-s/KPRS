<?php

namespace App\Http\Controllers;

use App\Detailkpr;
use App\Pangkat;
use App\User;
use App\Chart;
use App\Fasilitas;
use App\FasilitasRumah;
use App\Gambar;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Riwayat;
use App\Rumah;
use App\Transaksi;
use Illuminate\Support\Facades\Http;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
// use Closure;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {




        $nrp = Auth::user()->nrp;
        $massdebet = 0;
        $cekkpr = Detailkpr::where('nrp',$nrp)->first();
        if (Auth::user()->role == "2" && !empty($cekkpr))
        {
            $kpr = Detailkpr::where('nrp',$nrp)->first();
            //dd($kpr);
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
            $riwayat = Riwayat::where('nrp',$nrp)->first();
            $transaksi = Transaksi::where('nrp',$nrp)->get();

            // $ambil_tahun = DB::table('transaksi')->where('nrp', $nrp)
            //     ->select(DB::raw('thn as year'))->distinct()->orderByDesc('thn')->get();
            // $years = $ambil_tahun->pluck('year');


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
            $besar_angsuran = round($besar_angsur, -3) ;

            if ($besar_angsuran != $kpr->jml_angs) {
                $besar_angsuran = round($besar_angsur, -3) + 1000;
            }

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

            // dd($utang_pokok_total);
            // echo $i;

            //TOTAL BUNGA POKOK YANG DULU (SALAH)
            // $total_bunga = array_sum($array1);
            // $total_pokok = round(array_sum($array2));
            // dd($utang_bunga_total);

            // BIKIN FUNGSI UPDATE DISINI
            // Detailkpr::where('id',$id)->update([
            //     'pokok' => $total_pokok,
            //     'bunga' => $total_bunga
            // ]);
            // echo 'besar_angsuran '.$besar_angsuran;
            $array_all = [
                'bunga' => $array1,
                'pokok' => $array2,
                'pinjaman' => $array3,
                'besar_angsuran' => $array4
            ];

            $riwayat = Riwayat::where('nrp',$nrp)->first();
            $transaksi = Transaksi::where('nrp',$nrp)->where('status', '0001')->get();
            $user = Detailkpr::where('nrp', $nrp)->first();

            $ambil_tahun = DB::table('TrxBri')->where('nrp', $nrp)->where('status', '0001')
                ->select(DB::raw('YEAR(tanggal) as year'))->distinct()->orderByDesc('tanggal')->get();
            $years = $ambil_tahun->pluck('year');

            return view('index',[
                'transaksi' => DB::table('TrxBri')->where('nrp',$nrp)->whereNotNull('rekeningdebet')->orderBy('tanggal','ASC')->get(),
                'jumlah' => DB::table('kpr')->select('jml_angs')->where('nrp',$nrp)->first(),
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
                'transaksi' => $transaksi,
                'riwayat' => $riwayat,
                'years' => $years,
                'user' => $user,
                'massdebat'=> $massdebet,
            ]);
        }

        if(Auth::user()->role == '2' && empty($cekkpr)){
            // $rumahs = Rumah::where('status', 0)->latest()->paginate(5);


            // $respo nse = Http::get('http://example.com');


            return view('index');
        }
        $ambil_tahun = DB::table('kpr')->select(DB::raw('YEAR(tmt_angsuran) as year'))->distinct()->orderBy('tmt_angsuran')->get();
        $years = $ambil_tahun->pluck('year');

        $year = Carbon::now()->format('Y');
        $tahunini = DB::table('kpr')->whereYear('tmt_angsuran', $year);
        $jumlahpinjamantahun = $tahunini->sum('pinjaman');
        $totaltunggakantahun = $tahunini->sum('jml_tunggakan');
        $total_pokok_tahun = $tahunini->sum('pokok');
        $total_bunga_tahun = $tahunini->sum('bunga');
        $detail_btn = Detailkpr::select('jk_waktu', 'bunga', 'pokok', 'piutang_bunga', 'piutang_pokok', DB::raw('count(*) as total, SUM(bunga) as bunga, SUM(pokok) as pokok, SUM(piutang_bunga) as piutang_bunga, SUM(piutang_pokok) as piutang_pokok'))->where('status',3)->groupBy('jk_waktu')->get();
        $detail_kpr = Detailkpr::select('jk_waktu', 'bunga', 'pokok', 'piutang_bunga', 'piutang_pokok', DB::raw('count(*) as total, SUM(bunga) as bunga, SUM(pokok) as pokok, SUM(piutang_bunga) as piutang_bunga, SUM(piutang_pokok) as piutang_pokok'))->where('status','!=',3)->groupBy('jk_waktu')->get();
        $piutang_bunga = Detailkpr::where('status','!=',3)->sum('piutang_bunga');
        $piutang_pokok = Detailkpr::where('status','!=',3)->sum('piutang_pokok');
        $piutang_bunga_btn = Detailkpr::where('status',3)->sum('piutang_bunga');
        $piutang_pokok_btn = Detailkpr::where('status',3)->sum('piutang_pokok');

        // $count = Detailkpr::count();
        $count = DB::table('kpr')->whereYear('tmt_angsuran', $year)->count();
        $kpr = Detailkpr::all();
        $besar_pinjaman = [];
        $jangka = [];
        $angs_ke = [];
        //arrayin
        foreach ($kpr as $key) {
            array_push($besar_pinjaman, $key->pinjaman);
            array_push($jangka, $key->jk_waktu);
            array_push($angs_ke, $key->angs_ke);
        }
        $bunga = 6;


        $bungapersen = $bunga / 100;
        $tahun = $jangka[1] / 12;

        $c = pow((1 + $bungapersen), $tahun);
        $d = $c - 1;
        $fax = ($bungapersen * $c) / $d;
        $anuitas = round($fax, 6);
        $array_orang1 = [];
        $array_orang2 = [];
        $array_orang3 = [];
        for ($index = 0; $index < $count; $index++) {
            $besar_angsur = ($besar_pinjaman[$index] * $anuitas) / 12;

            // $besar_angsuran = round($besar_angsur, -2) + 100;
            $besar_angsuran = round($besar_angsur, -2) + 100;

            $array1 = [0 => null];
            $array2 = [0 => null];
            $array3 = [0 => intval($besar_pinjaman[$index])];
            $no = 1;

            $angsuran_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

            for ($i = 1; $i < $jangka[$index] + 1; $i++) {

                if ($no == 13) {
                    $ang_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga, 2);
                    $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
                    $no = 1;
                }
                $no++;
                array_push($array1, $angsuran_bunga);
                array_push($array2, $angsuran_pokok);


                $besar_pinjaman[$index] -= $array2[$i];
                array_push($array3, $besar_pinjaman[$index]);
            }
            $total_orang1 = array_sum($array1);
            $total_orang2 = array_sum($array2);

            array_push($array_orang1, $total_orang1);
            array_push($array_orang2, $total_orang2);
            array_push($array_orang3, $array3);
        }

        $total_pokok_otomatis = array_sum($array_orang1);
        $total_bunga_otomatis = array_sum($array_orang2);

        // dd($total_bunga);

        // echo 'besar_angsuran '.$besar_angsuran;
        $array_all = [
            'bunga' => $array1,
            'pokok' => $array2,
            'pinjaman' => $array3,
        ];
        // echo $total_pokok;

        $total_pokok = Detailkpr::where('status','!=',3)->sum('pokok');
        $total_bunga = Detailkpr::where('status','!=',3)->sum('bunga');

        $jumlahpinjaman = Detailkpr::where('status','!=',3)->sum('pinjaman');
        $totaltunggakan = Detailkpr::where('status','!=',3)->sum('jml_tunggakan');

            //rumus rekap

            $debiturbaru = Detailkpr::where('status', 2)->count();
            $debiturlunas = Detailkpr::where('status', 4)->count();
            $debiturmeninggal = Detailkpr::where('status', 5)->count();
            $hutangpokok = Detailkpr::sum('piutang_pokok');
            $tunggakanbunga = Detailkpr::sum('tunggakan_bunga');
            $rekapoutstanding = $hutangpokok + $tunggakanbunga;

        //btn


        $total_pokok_btn = Detailkpr::where('status',3)->sum('pokok');
        $total_bunga_btn = Detailkpr::where('status',3)->sum('bunga');

        $jumlahpinjaman_btn = Detailkpr::where('status',3)->sum('pinjaman');
        $totaltunggakan_btn = Detailkpr::where('status',3)->sum('jml_tunggakan');

        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count')->all();

        $groups = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')->all();

        for ($i = 0; $i <= count($groups); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        $chart = new Chart;
        $chart->labels = (array_keys($groups));
        $chart->dataset = (array_values($groups));
        $chart->colours = $colours;


        return view('index', compact('chart'), [
            'total_pokok_otomatis' => $total_pokok_otomatis,
            'total_bunga_otomatis' => $total_bunga_otomatis,
            'total_pokok_tahun' => $total_pokok_tahun,
            'total_bunga_tahun' => $total_bunga_tahun,
            'jumlahpinjamantahun' => $jumlahpinjamantahun,
            'totaltunggakantahun' => $totaltunggakantahun,
            'years' => $years,

            'pengelola' => User::where('role', 1)->count(),
            'admin' => User::where('role', 0)->count(),
            // 'pangkats' => Pangkat::count(),

            'debiturbaru' => $debiturbaru,
            'debiturlunas' => $debiturlunas,
            'debiturmeninggal' => $debiturmeninggal,
            'rekapoutstanding' => $rekapoutstanding,


            'total_pokok' => $total_pokok,
            'total_bunga' => $total_bunga,
            'jumlahpinjaman' => $jumlahpinjaman,
            'totaltunggakan' => $totaltunggakan,
            'piutang_bunga' => $piutang_bunga,
            'piutang_pokok' => $piutang_pokok,
            'user' => Detailkpr::where('status','!=',3)->count(),
            'detail_kpr' => $detail_kpr,

            'total_pokok_btn' => $total_pokok_btn,
            'total_bunga_btn' => $total_bunga_btn,
            'jumlahpinjaman_btn' => $jumlahpinjaman_btn,
            'totaltunggakan_btn' => $totaltunggakan_btn,
            'piutang_bunga_btn' => $piutang_bunga_btn,
            'piutang_pokok_btn' => $piutang_pokok_btn,
            'user_btn' => Detailkpr::where('status',3)->count(),
            'detail_btn' => $detail_btn
        ]);

    }



    public function refresh(Request $request)
    {
        // tangkap data detailkpr
        $year = Carbon::now()->format($request->tahun);
        $kpr = Detailkpr::whereYear('tmt_angsuran', $year)->get();
        // variable yang dibutuhkan
        $besar_pinjaman = [0 => 'besar pinjaman'];
        $jangka = [0 => 'jangka'];
        $angsuran_masuk = [0 => 'angsuran masuk'];
        $sisa_angsuran = [0 => 'sisa angsuran'];
        $tunggakan = [0 => 'tunggakan'];
        $id = [];
        $bulan = [0 => 'tmt_angsuran'];

        $bunga = 6;
        $array_orang_pokok = [];
        $array_orang_bunga = [];
        //foreach data kpr
        foreach ($kpr as $key) {
            array_push($tunggakan, $key->tunggakan);
            array_push($id, $key->id);
            array_push($besar_pinjaman, $key->pinjaman);
            array_push($jangka, $key->jk_waktu);
            array_push($angsuran_masuk, $key->angsuran_masuk);
            array_push($sisa_angsuran, ($key->jk_waktu - $key->angsuran_masuk) + $key->tunggakan);
        }
        // dd($id);
        for ($index = 1; $index <= count($id); $index++) {

            //tentuin bunga ke persen 6 ke 6%
            $bungapersen = $bunga / 100;

            // tentuin tahun dari jangka
            $tahun = $jangka[$index] / 12;

            // ===>mencari anuitas<===
            $c = pow((1 + $bungapersen), $tahun);
            $d = $c - 1;
            $fax = ($bungapersen * $c) / $d;
            $anuitas = round($fax, 6);
            // ===>mencari anuitas<===

            $besar_angsur = ($besar_pinjaman[$index] * $anuitas) / 12;
            $besar_angsuran = round($besar_angsur, -2) + 100;

            $array_bunga = [0 => 'bunga'];
            $array_pokok = [0 => 'pokok'];
            $array_pinjaman = [0 => 'pinjaman'];

            $no = 1;
            $angsuran_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
            // echo $kpr->count();
            // dd($kpr[1526]->tmt_angsuran);

            $bulan = (int)date('m', strtotime($kpr[$index - 1]->tmt_angsuran));
            $b = 1;

            for ($i = $bulan; $i < $jangka[$index] + $bulan; $i++) {

                if ($no == 13) {
                    $ang_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }

                $no++;
                array_push($array_bunga, $angsuran_bunga);
                array_push($array_pokok, $angsuran_pokok);

                $besar_pinjaman[$index] -= $array_pokok[$b];
                $b++;
                array_push($array_pinjaman, $besar_pinjaman);
            }
            $total_bunga = array_sum($array_bunga);
            $total_pokok = array_sum($array_pokok);
            // array_push($array_orang_piutang, $piutang);
            array_push($array_orang_pokok, $total_pokok);
            array_push($array_orang_bunga, $total_bunga);
        }
        for ($i = 0; $i < count($id); $i++) {
            Detailkpr::where('id', $id[$i])->update([
                'piutang_bunga' => $array_orang_bunga[$i],
                'piutang_pokok' => $array_orang_pokok[$i]
            ]);
        }


        // SALDO ---===============
        // $kpr = Detailkpr::where('nrp', 31040534120285)
        //     ->orWhere('nrp', 31050781290686)
        //     ->get();
        // variable yang dibutuhkan
        $besar_pinjaman_saldo = [0 => 'besar pinjaman'];
        $jangka_saldo = [0 => 'jangka'];
        $angsuran_masuk_saldo = [0 => 'angsuran masuk'];
        $sisa_angsuran_saldo = [0 => 'sisa angsuran'];
        $tunggakan_saldo = [0 => 'tunggakan'];
        $id_saldo = [];

        $array_orang_pokok_saldo = [];
        $array_orang_bunga_saldo = [];
        //foreach data kpr
        foreach ($kpr as $key) {
            array_push($tunggakan_saldo, $key->tunggakan);
            array_push($id_saldo, $key->id);
            array_push($besar_pinjaman_saldo, $key->pinjaman);
            array_push($jangka_saldo, $key->jk_waktu);
            array_push($angsuran_masuk_saldo, $key->angsuran_masuk);
            array_push($sisa_angsuran_saldo, ($key->angs_ke - $key->angsuran_masuk) + $key->tunggakan);
        }
        for ($index = 1; $index <= count($id_saldo); $index++) {

            //tentuin bunga ke persen 6 ke 6%
            $bungapersen = $bunga / 100;

            // tentuin tahun dari jangka
            $tahun = $jangka_saldo[$index] / 12;

            // ===>mencari anuitas<===
            $c = pow((1 + $bungapersen), $tahun);
            $d = $c - 1;
            $fax = ($bungapersen * $c) / $d;
            $anuitas = round($fax, 6);
            // ===>mencari anuitas<===


            $besar_angsur = ($besar_pinjaman_saldo[$index] * $anuitas) / 12;
            $besar_angsuran = $besar_angsur;

            $array_bunga = [0 => 'bunga'];
            $array_pokok = [0 => 'pokok'];
            $array_pinjaman = [0 => 'pinjaman'];

            $no = 1;
            $angsuran_bunga = $besar_pinjaman_saldo[$index] * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

            $bulan = (int)date('m', strtotime($kpr[$index - 1]->tmt_angsuran));
            $b = 1;

            for ($i = $bulan; $i <= $jangka[$index] + $bulan; $i++) {

                if ($no == 13 || $i == 13) {
                    $ang_bunga = $besar_pinjaman_saldo[$index] * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }
                $no++;
                array_push($array_bunga, $angsuran_bunga);
                array_push($array_pokok, $angsuran_pokok);

                $besar_pinjaman_saldo[$index] -= $array_pokok[$b];
                array_push($array_pinjaman, $besar_pinjaman_saldo);
                $b++;
            }
            $total_bunga = array_sum($array_bunga);
            $total_pokok = array_sum($array_pokok);
            // array_push($array_orang_piutang, $piutang);
            array_push($array_orang_pokok_saldo, $total_pokok);
            array_push($array_orang_bunga_saldo, $total_bunga);
        }

        for ($i = 0; $i < count($id_saldo); $i++) {
            Detailkpr::where('id', $id_saldo[$i])->update([
                'bunga' => $array_orang_bunga_saldo[$i],
                'pokok' => $array_orang_pokok_saldo[$i]
            ]);
        }

        // foreach ($kpr as $data) {
        //     echo 'id = ' . $data->id . '<br>';
        //     echo 'bunga = ' . $data->bunga . '<br>';
        //     echo 'pokok = ' . $data->pokok . '<br>';
        // }
        Alert::success('Informasi Pesan', 'Refresh piutang berhasil');
        return redirect()->route('home');
    }




    public function refresh_piutang(Request $request)
    {
        // tangkap data detailkpr
        $year = Carbon::now()->format($request->tahun);
        // $kpr = Detailkpr::where('nrp', 2920064750672)->orWhere('nrp', 12090015670887)->get();
        // $kpr = Detailkpr::whereYear('created_at', 2021)->whereMonth('created_at', 7)->get();
        // dd($kpr);
        $kpr = Detailkpr::select('id', 'tunggakan', 'pinjaman', 'jk_waktu', 'angsuran_masuk', 'angs_ke', 'nama', 'tmt_angsuran')->whereYear('tmt_angsuran', $year)->get();
        // variable yang dibutuhkan
        $besar_pinjaman = [0 => 'besar pinjaman'];
        $jangka = [0 => 'jangka'];
        $angsuran_masuk = [0 => 'angsuran masuk'];
        $sisa_angsuran = [0 => 'sisa angsuran'];
        $tunggakan = [0 => 'tunggakan'];
        $id = [0 => 'id'];
        $bulan = [0 => 'tmt_angsuran'];
        $angsuran_ke = [0 => 'angsuran ke'];
        $jml_angs = [0 => 'jml_angs'];
        $bunga = 6;

        $array_orang_pokok = [];
        $array_orang_bunga = [];

        //ARRAY BUAT POKOK DAN BUNGA SAMPAI AKHIR
        $total_pokok_akhir = [];
        $total_bunga_akhir = [];

        //ARRAY BUAT PIUTANG POKOK DAN BUNGA
        $array_orang_pokok_piutang = [0 => 'piutang pokok'];
        $array_orang_bunga_piutang = [0 => 'piutang bunga'];

        //ARRAY BUAT SALDO POKOK DAN BUNGA
        $array_orang_pokok_saldo = [0 => 'saldo pokok'];
        $array_orang_bunga_saldo = [0 => 'saldo bunga'];

        //ARRAY BUAT PIUTANG POKOK DAN BUNGA
        $tunggakan_pokok = [0 => 'tunggakan pokok'];
        $tunggakan_bunga = [0 => 'tunggakan bunga'];

        $tmt_angsuran = [0 => 'tmt_angsuran'];

        $inisial_pokok = [0 => 'inisial pokok'];
        $inisial_bunga = [0 => 'inisial bunga'];


        $awal = [];
        $akhir = [];
        $selisih = [];
        $selisih_bulan = [0 => 'selisih bulan'];
        $array_bulan_juli = [];

        $tes = [];
        //foreach data kpr
        foreach ($kpr as $key) {
            array_push($tunggakan, $key->tunggakan);
            array_push($id, $key->id);
            array_push($besar_pinjaman, $key->pinjaman);
            array_push($jangka, $key->jk_waktu);
            array_push($angsuran_masuk, $key->angsuran_masuk);
            array_push($angsuran_ke, $key->angs_ke);
            array_push($jml_angs, $key->jml_angs);
            array_push($sisa_angsuran, ($key->jk_waktu - $key->angsuran_masuk) + $key->tunggakan);

            array_push($tmt_angsuran, $key->tmt_angsuran);
        }
        for ($index = 1; $index < count($id); $index++) {
            // echo $id[$index] . "<br>";
            //tentuin bunga ke persen 6 ke 6%
            $bungapersen = $bunga / 100;

            // tentuin tahun dari jangka
            $tahun = $jangka[$index] / 12;

            // ===>mencari anuitas<===
            $c = pow((1 + $bungapersen), $tahun);
            $d = $c - 1;
            $fax = ($bungapersen * $c) / $d;
            $anuitas = round($fax, 6);
            // ===>mencari anuitas<===

            $besar_angsur = ($besar_pinjaman[$index] * $anuitas) / 12;
            $besar_angsuran = round($besar_angsur, -3);
            if ($besar_angsuran != $jml_angs[$index]) {
                $besar_angsuran = round($besar_angsur, -3) + 1000;
            }
            $array_bunga = [0 => 'bunga'];
            $array_pokok = [0 => 'pokok'];
            $array_pinjaman = [0 => 'pinjaman'];
            $b = 1;
            $no = 1;

            $angsuran_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

            // echo $kpr->count();
            // dd($kpr[1526]->tmt_angsuran);

            $bulan = (int) date('m', strtotime($kpr[$index - 1]->tmt_angsuran));

            //data awal
            $awal = strtotime($tmt_angsuran[$index]);
            $akhir = strtotime('2021-07-30');

            // $diff = date_diff($awal, $akhir);
            // $selisih = $diff->m;

            // //convert
            // // $timeStart = strtotime($tgl_mulai);
            // // $timeEnd = strtotime($tgl_selesai);

            // Menambah bulan ini + semua bulan pada tahun sebelumnya
            $selisih = 1 + (date("Y", $akhir) - date("Y", $awal)) * 12;

            // hitung selisih bulan
            $selisih += date("m", $akhir) - date("m", $awal);

            array_push($selisih_bulan, $selisih);

            for ($i = $bulan; $i < $jangka[$index] + $bulan; $i++) {
                if ($i == 13 || $no == 13) {
                    $ang_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }
                $no++;
                array_push($array_bunga, $angsuran_bunga);
                array_push($array_pokok, $angsuran_pokok);

                $besar_pinjaman[$index] -= $array_pokok[$b];
                $b++;
                array_push($array_pinjaman, $besar_pinjaman);
            }
            // $sisa_angsuran = ($kpr->jk_waktu - $kpr->angsuran_masuk) + $kpr->tunggakan;



            // echo $utang_pokok_total . "<br>";

            //CARI TOTAL BUNGA DAN POKOK SAMPE AKHIR
            // $total_bunga = array_sum($array_bunga);
            // $total_pokok = array_sum($array_pokok);
            // array_push($total_bunga_akhir, $total_bunga);
            // array_push($total_pokok_akhir, $total_pokok);


            // array_push($array_orang_piutang, $piutang);

            //CARI INISIAL POKOK DAN BUNGA
            // array_push($inisial_pokok, last($array_pokok));
            // array_push($inisial_bunga, last($array_bunga));

            //CARI FIELD PIUTANG_POKOK DAN PIUTANG_BUNGA
            $utang_bunga_total = array_sum(array_slice($array_bunga, $angsuran_masuk[$index] + 1, $jangka[$index]));
            $utang_pokok_total = array_sum(array_slice($array_pokok, $angsuran_masuk[$index] + 1, $jangka[$index]));
            array_push($array_orang_pokok_piutang, $utang_pokok_total);
            array_push($array_orang_bunga_piutang, $utang_bunga_total);

            //CARI FIELD POKOK DAN SALDO
            $saldo_pokok_total = array_sum(array_slice($array_pokok, 0, $angsuran_masuk[$index] + 1));
            $saldo_bunga_total = array_sum(array_slice($array_bunga, 0, $angsuran_masuk[$index] + 1));
            array_push($array_orang_pokok_saldo, $saldo_pokok_total);
            array_push($array_orang_bunga_saldo, $saldo_bunga_total);

            //CARI TUNGGAKAN POKOK DAN BUNGA
            $tunggakan_pokok_orang = array_sum(array_slice($array_pokok, $angsuran_masuk[$index] + 1, $tunggakan[$index]));
            $tunggakan_bunga_orang = array_sum(array_slice($array_bunga, $angsuran_masuk[$index] + 1, $tunggakan[$index]));
            array_push($tunggakan_pokok, $tunggakan_pokok_orang);
            array_push($tunggakan_bunga, $tunggakan_bunga_orang);

            array_push($tes, array_slice($array_pokok, $angsuran_masuk[$index] + 1, $tunggakan[$index]));
        }
        // dd($tes);
        // dd(array_slice($array_pokok, $angsuran_masuk[5] + 1, $tunggakan[5]));
        // dd($tunggakan[8]);
        // dd($tunggakan_pokok);
        // dd($id);

        // INI UNTUK UPDATE
        for ($i = 1; $i < count($id); $i++) {
            Detailkpr::where('id', $id[$i])->update([
                // 'inisial_pokok' => $inisial_pokok[$i],
                // 'inisial_bunga' => $inisial_bunga[$i],
                'pokok' => $array_orang_pokok_saldo[$i],
                'bunga' => $array_orang_bunga_saldo[$i],
                'piutang_pokok' => $array_orang_pokok_piutang[$i],
                'piutang_bunga' => $array_orang_bunga_piutang[$i],
                'tunggakan_pokok' => $tunggakan_pokok[$i],
                'tunggakan_bunga' => $tunggakan_bunga[$i]
            ]);
        }

        // foreach ($kpr as $data) {
        //     echo 'id = ' . $data->id . '<br>';
        //     echo 'bunga = ' . $data->bunga . '<br>';
        //     echo 'pokok = ' . $data->pokok . '<br>';
        // }
        Alert::success('Informasi Pesan', 'Refresh piutang berhasil tahun : '.$request->tahun);
        // return redirect()->route('home');
        return back();
    }

    public function refresh_saldo(Request $request)
    {
        // tangkap data detailkpr
        $year = Carbon::now()->format($request->tahun);
        // $kpr = Detailkpr::whereYear('tmt_angsuran', $year)->get();
        $kpr = Detailkpr::whereYear('tmt_angsuran', $year)->get();
        // $kpr = Detailkpr::select('id', 'tunggakan', 'pinjaman', 'jk_waktu', 'angsuran_masuk', 'angs_ke', 'nama', 'tmt_angsuran')->whereYear('tmt_angsuran', $year)->get();
        // $kpr = Detailkpr::where('nrp', '31180926460498')->get();
        // variable yang dibutuhkan
        $besar_pinjaman = [0 => 'besar pinjaman'];
        $jangka = [0 => 'jangka'];
        $angsuran_masuk = [0 => 'angsuran masuk'];
        $sisa_angsuran = [0 => 'sisa angsuran'];
        $tunggakan = [0 => 'tunggakan'];
        $nama = [0 => 'nama'];
        $tmt_angsuran = [0 => 'tmt angsuran'];
        $id = [];
        $bunga = 6;
        $sisa_pinjaman_pokok = [];
        $array_orang_pokok = [];
        $array_orang_bunga = [];

        //ARRAY BUAT POKOK DAN BUNGA SAMPAI AKHIR
        $total_pokok_akhir = [];
        $total_bunga_akhir = [];

        //ARRAY BUAT PIUTANG POKOK DAN BUNGA
        $array_orang_pokok_piutang = [0 => 'piutang pokok'];
        $array_orang_bunga_piutang = [0 => 'piutang bunga'];

        //ARRAY BUAT SALDO POKOK DAN BUNGA
        $array_orang_pokok_saldo = [0 => 'saldo pokok'];
        $array_orang_bunga_saldo = [0 => 'saldo bunga'];

        //ARRAY BUAT PIUTANG POKOK DAN BUNGA
        $tunggakan_pokok = [0 => 'tunggakan pokok'];
        $tunggakan_bunga = [0 => 'tunggakan bunga'];

        $tmt_angsuran = [0 => 'tmt_angsuran'];

        $inisial_pokok = [0 => 'inisial pokok'];
        $inisial_bunga = [0 => 'inisial bunga'];


        $awal = [];
        $akhir = [];
        $selisih = [];
        $selisih_bulan = [0 => 'selisih bulan'];
        $array_bulan_juli = [];

        $tes = [];
        $jml_angs = [0 => 'jml_angs'];
        //foreach data kpr
        foreach ($kpr as $key) {
            array_push($tunggakan, $key->tunggakan);
            array_push($id, $key->id);
            array_push($besar_pinjaman, $key->pinjaman);
            array_push($jangka, $key->jk_waktu);
            array_push($angsuran_masuk, $key->angsuran_masuk);
            array_push($sisa_angsuran, ($key->angs_ke - $key->angsuran_masuk) + $key->tunggakan);
            array_push($nama, $key->nama);
            array_push($jml_angs, $key->jml_angs);
            array_push($tmt_angsuran, $key->tmt_angsuran);
        }
        $test = [];
        for ($index = 1; $index <= count($id); $index++) {
            //tentuin bunga ke persen 6 ke 6%
            $bungapersen = $bunga / 100;

            // tentuin tahun dari jangka
            $tahun = $jangka[$index] / 12;

            // ===>mencari anuitas<===
            $c = pow((1 + $bungapersen), $tahun);
            $d = $c - 1;
            $fax = ($bungapersen * $c) / $d;
            $anuitas = round($fax, 6);
            // ===>mencari anuitas<===

            $besar_angsur = ($besar_pinjaman[$index] * $anuitas) / 12;
            $besar_angsuran = round($besar_angsur, -3);

            if ($besar_angsuran != $jml_angs[$index]) {
                $besar_angsuran = round($besar_angsur, -3) + 1000;
            }
            $array_bunga = [0 => 'bunga'];
            $array_pokok = [0 => 'pokok'];
            $array_pinjaman = [0 => 'pinjaman'];

            $no = 1;
            $angsuran_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

            $bulan = (int) date('m', strtotime($kpr[$index - 1]->tmt_angsuran));
            $b = 1;

            for ($i = $bulan; $i < $angsuran_masuk[$index] + $bulan; $i++) {

                if ($i == 13 || $no == 13) {
                    $ang_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }

                $no++;
                array_push($array_bunga, $angsuran_bunga);
                array_push($array_pokok, $angsuran_pokok);

                $besar_pinjaman[$index] -= $array_pokok[$b];
                $b++;
                array_push($array_pinjaman, $besar_pinjaman[$index]);
            }
            array_push($sisa_pinjaman_pokok, round(end($array_pinjaman)));
            array_push($test, $i);
            // $sisa_angsuran = ($kpr->jk_waktu - $kpr->angsuran_masuk) + $kpr->tunggakan;
            // $utang_bunga_total = array_sum(array_slice($array_bunga, $angsuran_masuk[$index]+1, $sisa_angsuran[$index]));
            // $utang_pokok_total = array_sum(array_slice($array_pokok, $angsuran_masuk[$index]+1, $sisa_angsuran[$index]));

            $saldo_pokok_total = array_sum(array_slice($array_pokok, 0, $angsuran_masuk[$index] + 1));
            $saldo_bunga_total = array_sum(array_slice($array_bunga, 0, $angsuran_masuk[$index] + 1));
            // $saldo_bunga_total = 0;
            // $saldo_pokok_total = 0;
            // for ($z=1; $z < $angsuran_masuk[$index]+1; $z++) {
            //     $saldo_bunga_total += $array_bunga[$z];
            //     $saldo_pokok_total += $array_pokok[$z];
            // }

            // echo $saldo_pokok_total . "<br>";

            // $total_bunga = array_sum($array_bunga);
            // $total_pokok = array_sum($array_pokok);
            // array_push($array_orang_piutang, $piutang);
            array_push($array_orang_pokok, $saldo_pokok_total);
            array_push($array_orang_bunga, $saldo_bunga_total);

            //CARI TUNGGAKAN POKOK DAN BUNGA
            $tunggakan_pokok_orang = array_sum(array_slice($array_pokok, $angsuran_masuk[$index] + 1, $tunggakan[$index]));
            $tunggakan_bunga_orang = array_sum(array_slice($array_bunga, $angsuran_masuk[$index] + 1, $tunggakan[$index]));
            array_push($tunggakan_pokok, $tunggakan_pokok_orang);
            array_push($tunggakan_bunga, $tunggakan_bunga_orang);

            // echo $index."/". $besar_angsuran."/". $nama[$index] . "/ POKOK:". $array_orang_pokok[$index - 1] . "<br>";
        }
        // INI UNTUK REFRESH UPDATE
        for ($i = 0; $i < count($id); $i++) {
            Detailkpr::where('id', $id[$i])->update([
                'sisa_pinjaman_pokok' => $sisa_pinjaman_pokok[$i]
            ]);
        }
        // foreach ($kpr as $data) {
        //     echo 'id = ' . $data->id . '<br>';
        //     echo 'bunga = ' . $data->bunga . '<br>';
        //     echo 'pokok = ' . $data->pokok . '<br>';
        // }
        Alert::success('Informasi Pesan', 'Refresh saldo berhasil');
        return back();
    }

    public function kalkulator()
    {
        return view('calculate.kalkulator');
    }
    public function HitungKalkulator(Request $request)
    {


        $bln = explode('-',$request->akad);
        $bln = intval($bln[1]);
        $data = app('App\Http\Controllers\AnuitasController')->TabelAngsuran($bln,$request->besar_pinjam,$request->jangka,$request->bunga);


        return view('calculate.show', [
            'all' => $data[0],
            'besar_angsuran' => $data[1],
            'no' => intval($request->jangka)
        ]);

    }

    public function show($id)
    {
        $rumah = Rumah::findOrFail($id);
        $gambar = Gambar::find($rumah->gambar_id);
        $fasilitas = FasilitasRumah::where('rumah_id', $id)->with('fasilitas:id,nama_fasilitas')->get();

        $kotamas = Detailkpr::select('kotama')->groupBy('kotama')->get()->toArray();
        $kotama = array_values(array_filter($kotamas, 'array_filter'));

        $gbr = [
            $gambar->gambar_satu,
            $gambar->gambar_kedua,
            $gambar->gambar_ketiga,
            $gambar->gambar_keempat,
            $gambar->gambar_kelima,
        ];

        return view('user.rumah.detailrumah', compact('rumah', 'gbr', 'fasilitas', 'kotama'));
    }
}
