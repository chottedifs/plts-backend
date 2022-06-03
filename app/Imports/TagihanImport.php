<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Tagihan;

class TagihanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Tagihan([
            'sewa_kios_id' => $row['sewa_id'],
            'histori_kios_id' => $row['histori_id'] ,
            'lokasi_id' => $row['lokasi_id'],
            'total_kwh' => $row['total_kwh'],
            'tagihan_kwh' => $row['tarif_dasar_kwh'] * $row['total_kwh'],
            'tagihan_kios' => $row['tarif_kios'],
            'total_tagihan' => $row['tarif_dasar_kwh'] * $row['total_kwh'] + $row['tarif_kios'],
            'periode' => date('Y-m-d'),
        ]);
    }
}
