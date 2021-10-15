<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Detailkpr;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
    public function databri()
    {

        return datatables(Detailkpr::where('status', 1)->orderBy('id', 'ASC'))
            ->addColumn('update', function($data){
                return '<a href="' . route('admin.detaildata.update.edit', $data->id) . '" class="text-success">Update</a>';
            })->addColumn('nama', function ($data) {
                return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
                <p>'.$data->nrp.'</p>';
            })->editColumn('pangkat', function ($data) {
                return $data->pangkat;
            })->editColumn('kesatuan', function ($data) {
                return $data->kesatuan;
            })->editColumn('tahap', function ($data) {
                return $data->tahap;
            })->editColumn('pinjaman', function ($data) {
                return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
            })->editColumn('jk_waktu', function ($data) {
                return $data->jk_waktu;
            })->editColumn('tmt_angsuran', function ($data) {
                return $data->tmt_angsuran;
            })->editColumn('jml_angs', function ($data) {
                return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
            })->editColumn('angs_ke', function ($data) {
                return $data->angs_ke;
            })->editColumn('angsuran_masuk', function ($data) {
                return $data->angsuran_masuk;
            })->editColumn('tunggakan', function ($data) {
                return $data->tunggakan;
            })->editColumn('jml_tunggakan', function ($data) {
                return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
            })->rawColumns(['update', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
            ->toJson();

    }

    public function manual()
    {
        return datatables(Detailkpr::where('status', 0)->orderBy('id', 'ASC'))
        ->addColumn('update', function($data){
            return '<a href="' . route('admin.detaildata.update.edit', $data->id) . '" class="text-success">Update</a>';
        })->editColumn('nama', function ($data) {
            return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
            <p>'.$data->nrp.'</p>';
        })->editColumn('pangkat', function ($data) {
            return $data->pangkat;
        })->editColumn('kesatuan', function ($data) {
            return $data->kesatuan;
        })->editColumn('tahap', function ($data) {
            return $data->tahap;
        })->editColumn('pinjaman', function ($data) {
            return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
        })->editColumn('jk_waktu', function ($data) {
            return $data->jk_waktu;
        })->editColumn('tmt_angsuran', function ($data) {
            return $data->tmt_angsuran;
        })->editColumn('jml_angs', function ($data) {
            return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
        })->editColumn('angs_ke', function ($data) {
            return $data->angs_ke;
        })->editColumn('angsuran_masuk', function ($data) {
            return $data->angsuran_masuk;
        })->editColumn('tunggakan', function ($data) {
            return $data->tunggakan;
        })->editColumn('jml_tunggakan', function ($data) {
            return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
        })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
        ->toJson();
    }

    public function databtn()
    {
        return datatables(Detailkpr::where('status', 3)->orderBy('id', 'ASC'))
        ->addColumn('update', function($data){
            return '<a href="' . route('admin.detaildata.update.edit', $data->id) . '" class="text-success">Update</a>';
        })->editColumn('nama', function ($data) {
            return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
            <p>'.$data->nrp.'</p>';
        })->editColumn('pangkat', function ($data) {
            return $data->pangkat;
        })->editColumn('kesatuan', function ($data) {
            return $data->kesatuan;
        })->editColumn('tahap', function ($data) {
            return $data->tahap;
        })->editColumn('pinjaman', function ($data) {
            return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
        })->editColumn('jk_waktu', function ($data) {
            return $data->jk_waktu;
        })->editColumn('tmt_angsuran', function ($data) {
            return $data->tmt_angsuran;
        })->editColumn('jml_angs', function ($data) {
            return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
        })->editColumn('angs_ke', function ($data) {
            return $data->angs_ke;
        })->editColumn('angsuran_masuk', function ($data) {
            return $data->angsuran_masuk;
        })->editColumn('tunggakan', function ($data) {
            return $data->tunggakan;
        })->editColumn('jml_tunggakan', function ($data) {
            return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
        })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
        ->toJson();
    }

    public function debitur()
    {
        return datatables(Detailkpr::orderBy('id', 'ASC')->get())
        ->addColumn('update', function($data){
            return '<a href="' . route('admin.detaildata.update.edit', $data->id) . '" class="text-success">Update</a>';
        })->editColumn('nama', function ($data) {
            return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
            <p>'.$data->nrp.'</p>';
        })->editColumn('pangkat', function ($data) {
            return $data->pangkat;
        })->editColumn('kesatuan', function ($data) {
            return $data->kesatuan;
        })->editColumn('tahap', function ($data) {
            return $data->tahap;
        })->editColumn('pinjaman', function ($data) {
            return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
        })->editColumn('jk_waktu', function ($data) {
            return $data->jk_waktu;
        })->editColumn('tmt_angsuran', function ($data) {
            return $data->tmt_angsuran;
        })->editColumn('jml_angs', function ($data) {
            return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
        })->editColumn('angs_ke', function ($data) {
            return $data->angs_ke;
        })->editColumn('angsuran_masuk', function ($data) {
            return $data->angsuran_masuk;
        })->editColumn('tunggakan', function ($data) {
            return $data->tunggakan;
        })->editColumn('jml_tunggakan', function ($data) {
            return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
        })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
        ->toJson();
    }
    public function debiturbaru()
    {
        return datatables(Detailkpr::where('status', 2)->orderBy('id', 'ASC'))
        ->addColumn('update', function($data){
            return '<a href="' . route('admin.detaildata.update.edit', $data->id) . '" class="text-success">Update</a>';
        })->editColumn('nama', function ($data) {
            return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
            <p>'.$data->nrp.'</p>';
        })->editColumn('pangkat', function ($data) {
            return $data->pangkat;
        })->editColumn('kesatuan', function ($data) {
            return $data->kesatuan;
        })->editColumn('tahap', function ($data) {
            return $data->tahap;
        })->editColumn('pinjaman', function ($data) {
            return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
        })->editColumn('jk_waktu', function ($data) {
            return $data->jk_waktu;
        })->editColumn('tmt_angsuran', function ($data) {
            return $data->tmt_angsuran;
        })->editColumn('jml_angs', function ($data) {
            return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
        })->editColumn('angs_ke', function ($data) {
            return $data->angs_ke;
        })->editColumn('angsuran_masuk', function ($data) {
            return $data->angsuran_masuk;
        })->editColumn('tunggakan', function ($data) {
            return $data->tunggakan;
        })->editColumn('jml_tunggakan', function ($data) {
            return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
        })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
        ->toJson();
    }

    public function debiturlunas()
    {
        return datatables(Detailkpr::where('status', 4)->orderBy('id', 'ASC'))
        ->addColumn('update', function($data){
            return '<a href="' . route('admin.detaildata.update.edit', $data->id) . '" class="text-success">Update</a>';
        })->editColumn('nama', function ($data) {
            return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
            <p>'.$data->nrp.'</p>';
        })->editColumn('pangkat', function ($data) {
            return $data->pangkat;
        })->editColumn('kesatuan', function ($data) {
            return $data->kesatuan;
        })->editColumn('tahap', function ($data) {
            return $data->tahap;
        })->editColumn('pinjaman', function ($data) {
            return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
        })->editColumn('jk_waktu', function ($data) {
            return $data->jk_waktu;
        })->editColumn('tmt_angsuran', function ($data) {
            return $data->tmt_angsuran;
        })->editColumn('jml_angs', function ($data) {
            return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
        })->editColumn('angs_ke', function ($data) {
            return $data->angs_ke;
        })->editColumn('angsuran_masuk', function ($data) {
            return $data->angsuran_masuk;
        })->editColumn('tunggakan', function ($data) {
            return $data->tunggakan;
        })->editColumn('jml_tunggakan', function ($data) {
            return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
        })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
        ->toJson();
    }
    public function meninggal()
    {
        return datatables(Detailkpr::where('status', 5)->orderBy('id', 'ASC'))
        ->addColumn('update', function($data){
            return '<a href="' . route('admin.detaildata.update.edit', $data->id) . '" class="text-success">Update</a>';
        })->editColumn('nama', function ($data) {
            return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
            <p>'.$data->nrp.'</p>';
        })->editColumn('pangkat', function ($data) {
            return $data->pangkat;
        })->editColumn('kesatuan', function ($data) {
            return $data->kesatuan;
        })->editColumn('kotama', function ($data) {
            return $data->kotama;
        })->editColumn('tahap', function ($data) {
            return $data->tahap;
        })->editColumn('pinjaman', function ($data) {
            return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
        })->editColumn('jk_waktu', function ($data) {
            return $data->jk_waktu;
        })->editColumn('tmt_angsuran', function ($data) {
            return $data->tmt_angsuran;
        })->editColumn('jml_angs', function ($data) {
            return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
        })->editColumn('angs_ke', function ($data) {
            return $data->angs_ke;
        })->editColumn('angsuran_masuk', function ($data) {
            return $data->angsuran_masuk;
        })->editColumn('tunggakan', function ($data) {
            return $data->tunggakan;
        })->editColumn('jml_tunggakan', function ($data) {
            return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
        })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan'])
        ->toJson();
    }

    public function dataoutstanding()
    {
        return datatables(Detailkpr::orderBy('id', 'ASC')->get())
                ->editColumn('nama', function ($data) {
                    return '<b>'.$data->nama.'</b><p>'.$data->nrp.'</p>';
                })->editColumn('pangkat', function ($data) {
                    return $data->pangkat;
                })->editColumn('kesatuan', function ($data) {
                    return $data->kesatuan;
                })->editColumn('piutang_pokok', function ($data) {
                    return  'Rp.'. number_format($data->piutang_pokok, 0, ',', '.');
                })->editColumn('tunggakan_bunga', function ($data) {
                    return 'Rp.'. number_format($data->tunggakan_bunga, 0, ',', '.');
                })->addColumn('outstanding', function ($data) {
                    return 'Rp.'. number_format($data->tunggakan_bunga + $data->piutang_pokok, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'piutang_pokok', 'tunggakan_bunga', 'outstanding'])
                ->toJson();
    }

    public function datapenerimaan()
    {
        return datatables(Detailkpr::orderBy('id', 'ASC')->get())
                ->editColumn('nama', function ($data) {
                    return '<b>'.$data->nama.'</b><p>'.$data->nrp.'</p>';
                })->editColumn('pangkat', function ($data) {
                    return $data->pangkat;
                })->editColumn('kesatuan', function ($data) {
                    return $data->kesatuan;
                })->editColumn('pokok', function ($data) {
                    return  'Rp.'. number_format($data->pokok, 0, ',', '.');
                })->editColumn('bunga', function ($data) {
                    return 'Rp.'. number_format($data->bunga, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'piutang_pokok', 'tunggakan_bunga'])
                ->toJson();
    }
    public function databulanan()
    {
        // $tahun = ($request->tahun);
        // $bulan = ($request->bulan);
        // $rekap = Detailkpr::where('tmt_angsuran', 'like', '%'. $tahun .'%')
        // ->where('tmt_angsuran', 'like', '%'. $bulan .'%')
        // ->orderBy('tmt_angsuran')
        // ->get();

        return datatables(Detailkpr::orderBy('tmt_angsuran', 'ASC'))
            ->editColumn('nama', function ($data) {
                return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
                <p>'.$data->nrp.'</p>';
            })->editColumn('pangkat', function ($data) {
                return $data->pangkat;
            })->editColumn('kesatuan', function ($data) {
                return $data->kesatuan;
            })->editColumn('tahap', function ($data) {
                return $data->tahap;
            })->editColumn('pinjaman', function ($data) {
                return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
            })->editColumn('jk_waktu', function ($data) {
                return $data->jk_waktu;
            })->editColumn('tmt_angsuran', function ($data) {
                return $data->tmt_angsuran;
            })->editColumn('jml_angs', function ($data) {
                return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
            })->editColumn('angs_ke', function ($data) {
                return $data->angs_ke;
            })->editColumn('angsuran_masuk', function ($data) {
                return $data->angsuran_masuk;
            })->editColumn('tunggakan', function ($data) {
                return $data->tunggakan;
            })->editColumn('tunggakan_pokok', function ($data) {
                return "Rp. " . number_format($data->tunggakan_pokok, 0, ',', '.');
            })->editColumn('tunggakan_bunga', function ($data) {
                return "Rp. " . number_format($data->tunggakan_bunga, 0, ',', '.');
            })->editColumn('jml_tunggakan', function ($data) {
                return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
            })->editColumn('keterangan', function ($data) {
                return $data->keterangan;
            })->editColumn('rekening', function ($data) {
                return $data->rekening;
            })->editColumn('pokok', function ($data) {
                return  'Rp.'. number_format($data->pokok, 0, ',', '.');
            })->editColumn('bunga', function ($data) {
                return 'Rp.'. number_format($data->bunga, 0, ',', '.');
            })->editColumn('sisa_pinjaman_pokok', function ($data) {
                return 'Rp.'. number_format($data->sisa_pinjaman_pokok, 0, ',', '.');
            })->editColumn('inisial_pokok', function ($data) {
                return  'Rp.'. number_format($data->inisial_pokok, 0, ',', '.');
            })->editColumn('inisial_bunga', function ($data) {
                return 'Rp.'. number_format($data->inisial_bunga, 0, ',', '.');
            })->editColumn('piutang_pokok', function ($data) {
                return  'Rp.'. number_format($data->piutang_pokok, 0, ',', '.');
            })->editColumn('piutang_bunga', function ($data) {
                return 'Rp.'. number_format($data->tunggakan_bunga, 0, ',', '.');
            })->addColumn('outstanding', function ($data) {
                return 'Rp.'. number_format($data->tunggakan_bunga + $data->piutang_pokok, 0, ',', '.');
            })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan', 'sisa_pinjaman_pokok', 'tunggakan_pokok', 'tunggakan_bunga'])
            ->toJson();

            // return view('rekapbulan.index');

    }

    public function carirekap($request)
    {
        $tahun = ($request->tahun);
        $bulan = ($request->bulan);
        $search = Detailkpr::where('tmt_angsuran', 'like', '%'. $tahun .'%')
        ->where('tmt_angsuran', 'like', '%'. $bulan .'%')
        ->orderBy('tmt_angsuran')
        ->get();



        return Datatables::of($search)
        ->editColumn('nama', function ($data) {
            return '<a href="' . route('admin.detaildata.show', $data->id) . '" class="text-primary">' .$data->nama . '</a>
            <p>'.$data->nrp.'</p>';
        })->editColumn('pangkat', function ($data) {
            return $data->pangkat;
        })->editColumn('kesatuan', function ($data) {
            return $data->kesatuan;
        })->editColumn('tahap', function ($data) {
            return $data->tahap;
        })->editColumn('pinjaman', function ($data) {
            return "IDR. " . number_format($data->pinjaman, 0, ',', '.');
        })->editColumn('jk_waktu', function ($data) {
            return $data->jk_waktu;
        })->editColumn('tmt_angsuran', function ($data) {
            return $data->tmt_angsuran;
        })->editColumn('jml_angs', function ($data) {
            return "Rp. " . number_format($data->jml_angs, 0, ',', '.');
        })->editColumn('angs_ke', function ($data) {
            return $data->angs_ke;
        })->editColumn('angsuran_masuk', function ($data) {
            return $data->angsuran_masuk;
        })->editColumn('tunggakan', function ($data) {
            return $data->tunggakan;
        })->editColumn('tunggakan_pokok', function ($data) {
            return "Rp. " . number_format($data->tunggakan_pokok, 0, ',', '.');
        })->editColumn('tunggakan_bunga', function ($data) {
            return "Rp. " . number_format($data->tunggakan_bunga, 0, ',', '.');
        })->editColumn('jml_tunggakan', function ($data) {
            return "Rp. " . number_format($data->jml_tunggakan, 0, ',', '.');
        })->editColumn('keterangan', function ($data) {
            return $data->keterangan;
        })->editColumn('rekening', function ($data) {
            return $data->rekening;
        })->editColumn('pokok', function ($data) {
            return  'Rp.'. number_format($data->pokok, 0, ',', '.');
        })->editColumn('bunga', function ($data) {
            return 'Rp.'. number_format($data->bunga, 0, ',', '.');
        })->editColumn('sisa_pinjaman_pokok', function ($data) {
            return 'Rp.'. number_format($data->sisa_pinjaman_pokok, 0, ',', '.');
        })->editColumn('inisial_pokok', function ($data) {
            return  'Rp.'. number_format($data->inisial_pokok, 0, ',', '.');
        })->editColumn('inisial_bunga', function ($data) {
            return 'Rp.'. number_format($data->inisial_bunga, 0, ',', '.');
        })->editColumn('piutang_pokok', function ($data) {
            return  'Rp.'. number_format($data->piutang_pokok, 0, ',', '.');
        })->editColumn('piutang_bunga', function ($data) {
            return 'Rp.'. number_format($data->tunggakan_bunga, 0, ',', '.');
        })->addColumn('outstanding', function ($data) {
            return 'Rp.'. number_format($data->tunggakan_bunga + $data->piutang_pokok, 0, ',', '.');
        })->rawColumns(['update','nrp', 'nama','pangkat','kesatuan','kotama', 'pinjaman', 'jml_angs', 'jml_tunggakan', 'sisa_pinjaman_pokok', 'tunggakan_pokok', 'tunggakan_bunga'])
        ->toJson();

        return view('rekapbulan.cari');
    }

    public function datatunggakan()
    {
        return datatables(Detailkpr::orderBy('id', 'ASC')->get())
                ->editColumn('nama', function ($data) {
                    return '<b>'.$data->nama.'</b><p>'.$data->nrp.'</p>';
                })->editColumn('pangkat', function ($data) {
                    return $data->pangkat;
                })->editColumn('kesatuan', function ($data) {
                    return $data->kesatuan;
                })->editColumn('tunggakan_pokok', function ($data) {
                    return  'Rp.'. number_format($data->piutang_pokok, 0, ',', '.');
                })->editColumn('tunggakan_bunga', function ($data) {
                    return 'Rp.'. number_format($data->tunggakan_bunga, 0, ',', '.');
                })->editColumn('jml_tunggakan', function ($data) {
                    return 'Rp.'. number_format($data->jml_tunggakan, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'piutang_pokok', 'tunggakan_bunga', 'outstanding'])
                ->toJson();
    }

    public function datapiutang()
    {
        return datatables(Detailkpr::orderBy('id', 'ASC')->get())
                ->editColumn('nama', function ($data) {
                    return '<b>'.$data->nama.'</b><p>'.$data->nrp.'</p>';
                })->editColumn('pangkat', function ($data) {
                    return $data->pangkat;
                })->editColumn('kesatuan', function ($data) {
                    return $data->kesatuan;
                })->editColumn('piutang_pokok', function ($data) {
                    return  'Rp.'. number_format($data->piutang_pokok, 0, ',', '.');
                })->editColumn('piutang_bunga', function ($data) {
                    return 'Rp.'. number_format($data->tunggakan_bunga, 0, ',', '.');
                })->rawColumns(['nrp', 'nama', 'piutang_pokok', 'tunggakan_bunga', 'outstanding'])
                ->toJson();
    }

    public function pengajuan()
    {
        return datatables(Detailkpr::where('status', 2))
        ->addColumn('check', function ($data) {
            return '<input class="check-pengajuan" name="pengajuan[]" type="checkbox" value="'.$data->id.'">';
        })
        ->addColumn('status', function($data){
                    return $data->status == null || $data->status == 0 || $data->status == 2
                        ? "Belum Approval"
                        : "SUDAH APPROVAL";
                })->addColumn('nama', function($data) {
                    return $data->nama;
                })->addColumn('nrp', function($data) {
                    return $data->nrp;
                })->addColumn('pangkat', function($data) {
                    return $data->pangkat;
                })->addColumn('kesatuan', function($data) {
                    return $data->kesatuan;
                })->addColumn('pinjaman', function($data){
                    return "Rp." . number_format($data->pinjaman, 0,',','.');
                })->addColumn('jk_waktu', function($data) {
                    return $data->jk_waktu;
                })
                // ->addColumn('aksi', function($det){
                //     return '<button type="submit" onclick="confirmationUser('. "$det->id" .')" class="btn btn-success btn-sm">Approval <i class="fa fa-check"></i></button>
                //     <form action="'. route('confirmation', $det->id) .'" method="POST" id="ConfirmationUser'. $det->id .'">
                //         '.csrf_field().'
                //         '.method_field('patch').'
                //     </form>';
                // })
                ->rawColumns(['check','status', 'nrp', 'pinjaman'])
                ->toJson();

    }


}
