<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Tagihan;
use Str;

class TagihanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $kodeTagihan = $row['sewa_id'] . '-' . Str::random(5);
        return new Tagihan([
            'kode_tagihan' => $kodeTagihan,
            'user_id' => $row['user_id'],
            'sewa_kios_id' => $row['sewa_id'],
            'lokasi_id' => $row['lokasi_id'],
            'total_kwh' => $row['total_kwh'],
            'tagihan_kwh' => $row['tarif_dasar_kwh'] * $row['total_kwh'],
            'tagihan_kios' => $row['tarif_kios'],
            'periode' => date('Y-m-d'),
            'status_id' => 1,
            'diskon' => 0
        ]);
    }
}
