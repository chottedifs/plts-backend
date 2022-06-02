<?php

namespace App\Imports;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Tagihan;

class TagihanImport implements ToModel, WithHeadingRow
{
    // use Importable;

    // public function __construct()
    // {
    //     $this->historiKios = HistoriKios::select('id', 'sewa_kios_id')->get();
    // }

    public function model(array $row)
    {
        // $histori = $this->historiKios->where('id', $row['sewa_kios'])->first();
        return new TagihanImport([
            'sewa_kios_id' => $row['sewa_id'],
            'histori_kios_id' => $row['histori_id'] ,
            'lokasi_id' => $row['lokasi_id'],
            'total_kwh' => $row['total_kwh'],
            'tagihan_kwh' => $row['tarif_kios'],
            'tagihan_kios' => $row['tarif_kios'],
            'total_tagihan' => $row['tarif_kios'],
            'periode' => $row['periode'],
            // 'sewa_kios_id' => $row[1],
            // 'histori_kios_id' => $row[3] ,
            // 'lokasi_id' => $row[4],
            // 'total_kwh' => $row[10],
            // 'tagihan_kwh' => $row[7],
            // 'tagihan_kios' => $row[8],
            // 'total_tagihan' => $row[7],
            // 'periode' => $row[9],
        ]);
    }
}
