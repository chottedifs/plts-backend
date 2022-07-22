<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function all(Request $request){
        $informations = Informasi::all();

        // foreach ($tagihan as $dataTagihan){
        //     $response[] = [
        //         'id_sewa' => $dataTagihan->SewaKios->id,
        //         'id_tagihan' => $dataTagihan->id,
        //         'kode_tagihan' => $dataTagihan->kode_tagihan,
        //         'nama_penyewa' => $dataTagihan->User->nama_lengkap,
        //         'no_rekening' => $dataTagihan->User->no_rekening,
        //         'nama_kios' => $dataTagihan->SewaKios->RelasiKios->Kios->nama_kios,
        //         'lokasi_kios' => $dataTagihan->SewaKios->RelasiKios->Lokasi->nama_lokasi,
        //         'periode' => $dataTagihan->periode,
        //         'tagihan_kios' => $dataTagihan->tagihan_kios,
        //         'kwh' => $dataTagihan->total_kwh,
        //         'tagihan_kwh' => $dataTagihan->tagihan_kwh,
        //         'total_tagihan' => $dataTagihan->tagihan_kwh + $dataTagihan->tagihan_kios,
        //         'status_bayar' => $dataTagihan->MasterStatus->nama_status
        //         // 'nama_kios' => $dataKios->RelasiKios->Kios->nama_kios,
        //         // 'tipe_kios' => $dataKios->RelasiKios->TarifKios->tipe,
        //         // 'tarif_kios' => $dataKios->RelasiKios->TarifKios->harga,
        //         // 'tempat_kios' => $dataKios->RelasiKios->Kios->tempat,
        //         // 'lokasi_kios' => $dataKios->RelasiKios->Lokasi->nama_lokasi
        //     ];
        // };

        if($informations)
            return ResponseFormatter::success($informations, 'Data Sewa Kios Berhasil di Ambil');
        else
            return ResponseFormatter::error(null, 'Data Sewa Kios Tidak Ada', 404);
    }
}
