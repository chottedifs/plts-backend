<?php

namespace App\Exports;

use App\Models\SewaKios;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class TagihanExport implements FromCollection
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

        ddd($sewaKios);

        return $sewaKios;

        // return SewaKios::where()
    }
}
