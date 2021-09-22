<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Detailkpr;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class RekapbulananExport implements FromCollection
{
    protected $bulan;
    protected $tahun;
    function __construct($bulan, $tahun)
    {

        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $tgl =  date_create($this->tahun."-".$this->bulan."-"."01");
        $detailkpr = Detailkpr::select(
            'nama',
            'pangkat',
            'nrp',
            'kesatuan',
            'kotama',
            'tahap',
            'pinjaman',
            'jk_waktu',
            'tmt_angsuran',
            'jml_angs',
            'angs_ke',
            'angsuran_masuk',
            'tunggakan',
            'jml_tunggakan',
            'tunggakan_pokok',
            'tunggakan_bunga',
            'keterangan',
            'rekening',
            'rek_bri',
            'rek_btn',
            'bunga',
            'pokok',
            'sisa_pinjaman_pokok',
            'inisial_bunga',
            'inisial_pokok',
            'piutang_bunga',
            'piutang_pokok',
        )->where("tmt_angsuran", $tgl)->get();
        $data = collect($detailkpr)->map(function ($detailkpr, $key) {
            $collect = (object)$detailkpr;
            return [
                'nama' => $collect->nama,
                'pangkat' => $collect->pangkat,
                'nrp' => $collect->nrp.' ',
                'kesatuan' => $collect->kesatuan,
                'kotama' => $collect->kotama,
                'alamat' => $collect->alamat,
                'tahap' => $collect->tahap,
                'pinjaman' => $collect->pinjaman,
                'jk_waktu' => $collect->jk_waktu,
                'tmt_angsuran' => $collect->tmt_angsuran,
                'jml_angs' => $collect->jml_angs,
                'tunggakan' => $collect->tunggakan,
                'jml_tunggakan' => $collect->jml_tunggakan,
                'tunggakan_pokok' => $collect->tunggakan_pokok,
                'tunggakan_bunga' => $collect->tunggakan_bunga,
                'keterangan' => $collect->keterangan,
                'rekening' => $collect->rekening,
                'rek_bri' => $collect->rek_bri.' ',
                'rek_btn' => $collect->rek_btn.' ',
                'bunga' => $collect->bunga,
                'pokok' => $collect->pokok,
                'sisa_pinjaman_pokok' => $collect->sisa_pinjaman_pokok,
                'inisial_bunga' => $collect->inisial_bunga,
                'inisial_pokok' => $collect->inisial_pokok,
                'piutang_bunga' => $collect->piutang_bunga,
                'piutang_pokok' => $collect->piutang_pokok
            ];
        });
        ini_set('memory_limit', '-1');
        return $data;
    }
    public function headings(): array
    {
        return [
            'nama',
            'pangkat',
            'nrp',
            'kesatuan',
            'kotama',
            'alamat',
            'tahap',
            'pinjaman',
            'jk_waktu',
            'tmt_angsuran',
            'jml_angs',
            'angs_ke',
            'angsuran_masuk',
            'tunggakan',
            'jml_tunggakan',
            'tunggakan_pokok',
            'tunggakan_bunga',
            'keterangan',
            'rekening',
            'rek_bri',
            'rek_btn',
            'bunga',
            'pokok',
            'sisa_pinjaman_pokok',
            'inisial_bunga',
            'inisial_pokok',
            'piutang_bunga',
            'piutang_pokok'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $count = Detailkpr::count() + 1;
        $string = 'A1:AD' . $count;
        $sheet->getStyle('A1:AD1')->getFont()->setBold(true);
        $sheet->getStyle($string)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT,
            'U' => NumberFormat::FORMAT_TEXT,
            'V' => NumberFormat::FORMAT_TEXT,
            'W' => NumberFormat::FORMAT_TEXT
        ];
    }
}
