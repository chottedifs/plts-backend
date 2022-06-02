<?php

namespace App\Imports;

use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Tagihan;

class TagihanImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function __construct()
    {
        $this->historiKios = HistoriKios::select('id', 'sewa_kios_id')->get();
    }

    public function model(array $row)
    {
        $histori = $this->historiKios->where('id', $row['sewa_kios'])->first();
        return new TagihanImport([
            'sewa_kios_id',
            'histori_kios_id',
            'lokasi_id',
            'sewa_kios_id',
            'total_kwh',
            'tagihan_kwh',
            'tagihan_kios',
            'total_tagihan',
            'periode',
        ]);
    }
}
