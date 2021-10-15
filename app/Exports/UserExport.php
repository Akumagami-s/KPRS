<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    public $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    private function cekRole($role)
    {
        if ($role == 0) {
            return 'ADMIN';
        } else if ($role == 1) {
            return 'PENGELOLA';
        } else if ($role == 2) {
            return 'USER';
        } else if ($role == 3) {
            return 'ENDUSER';
        } else {
            return 'Tidak Memiliki Role';
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $accounts = User::select('id','name','email','email_verified_at','nrp','role','pangkat')
            ->search($this->search)
            ->orderBy('name')->get()->toArray();

        $users = collect($accounts)->map(function($accounts, $key){
            $collect = (object)$accounts;
            return [
                "id" => $collect->id,
                "name" => $collect->name,
                "email" => $collect->email,
                "email_verified_at" => $collect->email_verified_at,
                "nrp" => $collect->nrp,
                "role" => $this->cekRole($collect->role),
                "pangkat" => $collect->pangkat,
            ];
        });

        return $users;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nama',
            'Email',
            'Email Verifikasi',
            'NRP',
            'Status',
            'Pangkat'
        ];
    }
}
