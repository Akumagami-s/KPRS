<?php

namespace App\Http\Controllers\User;

use App\Detailkpr;
use App\Pangkat;
use App\Http\Controllers\Controller;
use App\Rumah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pinjaman.index', [
            'detail_kpr' => Detailkpr::where('nrp', auth()->user()->nrp)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $corps = Detailkpr::select('corps')->groupBy('corps')->get()->toArray();
        $corp = array_values(array_filter($corps, 'array_filter'));

        $kotamas = Detailkpr::select('kotama')->groupBy('kotama')->get()->toArray();
        $kotama = array_values(array_filter($kotamas, 'array_filter'));

        return view('user.pinjaman.create',compact('corp'),compact('kotama'), [
            'pangkats' => Pangkat::all()
        ]);
    }

    public function createRumah($id)
    {
        $rumah = Rumah::findOrFail($id);
        $corps = Detailkpr::select('corps')->groupBy('corps')->get()->toArray();
        $corp = array_values(array_filter($corps, 'array_filter'));

        $kotamas = Detailkpr::select('kotama')->groupBy('kotama')->get()->toArray();
        $kotama = array_values(array_filter($kotamas, 'array_filter'));

        return view('user.pinjaman.create',compact('corp', 'rumah'),compact('kotama'), [
            'pangkats' => Pangkat::all()
        ]);
    }

    public function dataKesatuan(Request $request)
    {
        $search = $request->kesatuan;

        $kesatuans = Detailkpr::select('kesatuan')->groupBy('kesatuan')
            ->orderBy('kesatuan')->where('kesatuan', 'like', "%$search%")
            ->pluck('kesatuan')->filter()->take(6)->toArray();

        $data = [];

        foreach (array_values($kesatuans) as $item) {
            $data[] = [
                'id' => $item,
                'text' => $item,
                'kesatuan' => $item
            ];
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'nama' => 'required',
            'ktp' => 'required',
            'alamat' => 'required',
            'nrp' => 'required',
            'kesatuan' => 'required',
            'jml_angs' => 'required',
            'pangkat' => 'required',
            'pinjaman' => 'required',
            'jk_waktu' => 'required',
            'rekening' => 'required',
            'nama_bank' => 'required',
            'kotama' => 'required'
        ]);
        $attr['status'] = 2;

        $pinjaman = $request->pinjaman;
        $attr['pinjaman'] = preg_replace('/[Rp. ]/','',$pinjaman);
        Rumah::where('id', request('rumah_id'))->update([
            'status' => 1
        ]);
        Detailkpr::create($attr);
        Alert::success('Informasi Pesan', 'Pinjaman berhasil diajukan');
        return redirect()->route('userpinjam.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refresh_jmlangs(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nrp' => 'required',
            'ktp' => 'required|numeric|digits:16',
            'alamat' => 'required',
            'pangkat' => 'required',
            'pinjaman' => 'required',
            'jk_waktu' => 'required',
            // 'jml_angs' => 'required',
            'kesatuan' => 'required',
            'rekening' => 'required',
            'nama_bank' => 'required'
        ]);

        $pinjaman = $request->pinjaman;
        $attr['pinjaman'] = preg_replace('/[Rp. ]/','',$pinjaman);

        $besar_pinjaman = $attr['pinjaman'];
        // $besar_pinjaman = $request->pinjaman;
        $bunga = 6;
        $jangka = $request->jk_waktu;

        $bungapersen = $bunga / 100;
        $tahun = $jangka / 12;

        $c = pow((1 + $bungapersen), $tahun);
        $d = $c - 1;
        $fax = ($bungapersen * $c) / $d;
        $anuitas = round($fax, 6);

        $besar_angsur = ($besar_pinjaman * $anuitas) / 12;

        $besar_angsuran = round($besar_angsur, -3) + 1000;

        $array1 = [0 => null];
        $array2 = [0 => null];
        $array3 = [0 => intval($besar_pinjaman)];
        $array4 = [0 => 0];
        $no = 1;
        $angsuran_bunga = $besar_pinjaman * $bungapersen / 12;
        $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
        for ($i = 1; $i < $jangka + 1; $i++) {

            if ($no == 13) {
                $ang_bunga = $besar_pinjaman * $bungapersen / 12;
                $angsuran_bunga = round($ang_bunga, 2);
                $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
                $no = 1;
            }
            $no++;
            array_push($array1, $angsuran_bunga);
            array_push($array2, $angsuran_pokok);


            $besar_pinjaman -= $array2[$i];
            array_push($array3, $besar_pinjaman);
        }

        $array_all = [
            'bunga' => $array1,
            'pokok' => $array2,
            'pinjaman' => $array3,
        ];

        return view('user.pinjaman.create', [
            'jml_angs' => $besar_angsuran,
            'all' => $array_all,
            'no' => intval($jangka),
            'rumah_id' => request('rumah_id')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
