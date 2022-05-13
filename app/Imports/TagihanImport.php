<?php

namespace App\Imports;

use App\Models\Outlet;
use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\ToModel;

class TagihanImport implements ToModel
{
    // private $outlets;

    // public function __construct()
    // {
    //     $this->outlets = Outlet::select('id','name_kios')->get();
    // }

    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '.'
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $outlet = Outlet::where('name_kios', $row['name_kios'])->first();
        return new Tagihan([
            // 'id_kios' => $user->id ?? NULL,
            'nilai_kwh_awal' => $row[0],
            'nilai_kwh_akhir' => $row[1],
            'total_kwh' => $row[2],
            // 'periode' => $row[date('M')]
        ]);
    }
}
