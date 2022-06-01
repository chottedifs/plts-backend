<?php

namespace App\Exports;

use App\Models\SewaKios;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TagihanExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            // $lokasiKios = RelasiKios::with('Lokasi')->where('lokasi_id', $lokasiPetugas)->get();
            $sewaKios = SewaKios::with('RelasiKios','HistoriKios')->where([
                'lokasi_id' => $lokasiPetugas,
                'status_sewa' => 1
                ])->get();
            // $sewaKios = SewaKios::with('RelasiKios')->get();
        } elseif ($roles == "admin") {
            $sewaKios = SewaKios::with('RelasiKios','HistoriKios')->where('status_sewa', 1)->get();
        }

        return $sewaKios;
    }

    public function map($sewaKios): array
    {
        $tanggal = date('M Y');
        return [
            $sewaKios->RelasiKios->Kios->nama_kios,
            $sewaKios->id,
            $sewaKios->RelasiKios->Kios->id,
            $sewaKios->User->nama_lengkap,
            $sewaKios->Lokasi->nama_lokasi,
            $tanggal,
        ];
    }

    public function headings(): array
    {
        return [
            ' ',
            'Id Sewa Kios',
            'Id Kios',
            'Nama Kios',
            'Lokasi Kios',
            'Periode',
            'Total KWH',
        ];
    }
}
