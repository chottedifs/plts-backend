<?php

namespace App\Exports;

use App\Models\SewaKios;
use App\Models\User;
use App\Models\TarifKwh;
use App\Models\HistoriKios;
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
            $sewaKios = SewaKios::with('RelasiKios')->where([
                'lokasi_id' => $lokasiPetugas,
                'status_sewa' => 1
                ])->get();
            // $historiKios = HistoriKios::with('SewaKios')->where('sewa_kios_id',$sewaKios->id)->get();
            // $sewaKios = SewaKios::with('RelasiKios')->get();
        } elseif ($roles == "admin") {
            $sewaKios = SewaKios::with('RelasiKios')->where('status_sewa', 1)->get();
        }

        return $sewaKios;
    }

    public function map($sewaKios): array
    {

        $historiKios = HistoriKios::with('SewaKios')->where('id',$sewaKios->id)->first();
        $tarif_dasar = TarifKwh::select('harga')->first();
        $tanggal = date('M Y');

        // ddd($historiKios->id);
        return [
            $sewaKios->RelasiKios->Kios->nama_kios,
            $sewaKios->id,
            $sewaKios->RelasiKios->Kios->id,
            $historiKios->id,
            $sewaKios->lokasi_id,
            $sewaKios->User->nama_lengkap,
            $sewaKios->Lokasi->nama_lokasi,
            $tarif_dasar->harga,
            $sewaKios->RelasiKios->TarifKios->harga,
            $tanggal,
        ];
    }

    public function headings(): array
    {
        return [
            ' ',
            'id_sewa',
            'id_kios',
            'id_histori',
            'lokasi_id',
            'nama_penyewa',
            'lokasi',
            'tarif_dasar_kwh',
            'tarif_kios',
            'periode',
            'total_kwh',
        ];
    }
}
