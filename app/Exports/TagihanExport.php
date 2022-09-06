<?php

namespace App\Exports;

use App\Models\SewaKios;
use App\Models\TarifKwh;
use Exception;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TagihanExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithStyles
{
    use RegistersEventListeners;

    public function collection()
    {
        $roles = Auth::user()->roles;
        if ($roles == "plts") {
            $sewaKios = SewaKios::with('RelasiKios', 'User')->where(['status_sewa' => 1, 'use_plts' => 1])->get();
            // $sewaKios = SewaKios::with('RelasiKios')->where('status_sewa', 1)->get();
            // $lokasiPlts = Auth::user()->Plts->lokasi_id;
            // // $lokasiKios = RelasiKios::with('Lokasi')->where('lokasi_id', $lokasiPlts)->get();
            // $sewaKios = SewaKios::with('RelasiKios')->where([
            //     'lokasi_id' => $lokasiPlts,
            //     'status_sewa' => 1
            //     ])->get();// $lokasiPlts = Auth::user()->Plts->lokasi_id;
            // // $lokasiKios = RelasiKios::with('Lokasi')->where('lokasi_id', $lokasiPlts)->get();
            // $sewaKios = SewaKios::with('RelasiKios')->where([
            //     'lokasi_id' => $lokasiPlts,
            //     'status_sewa' => 1
            //     ])->get();
            // // $sewaKios = SewaKios::with('RelasiKios')->get();
        }

        return $sewaKios;
    }

    public function map($sewaKios): array
    {
        $tarif_dasar = TarifKwh::select('harga')->first();
        $tanggal = date('M Y');

        // ddd($tarif_dasar);
        if ($sewaKios->RelasiKios->use_plts == 1) {
            $usePlts = 'PLTS';
        } else {
            $usePlts = 'PLN';
        }
        $pecah = explode('-', $sewaKios->tgl_sewa);
        $tahun = $pecah[0];
        $bulan = $pecah[1];
        if ($tahun == date('Y')) {
            if ($bulan == date('m')) {
                $keterangan = "Penyewa Baru pada " . date('M Y');
            } else {
                $keterangan = "Penyewa Lama";
            }
        }
        // if ()
        return [
            $sewaKios->RelasiKios->Kios->nama_kios,
            $sewaKios->User->id,
            $sewaKios->id,
            $sewaKios->RelasiKios->Kios->id,
            $sewaKios->lokasi_id,
            $sewaKios->User->nama_lengkap,
            $sewaKios->User->nik,
            $sewaKios->User->rekening,
            $sewaKios->Lokasi->nama_lokasi,
            $tarif_dasar->harga,
            $sewaKios->RelasiKios->TarifKios->harga,
            $tanggal,
            $keterangan,
            $usePlts
        ];
    }

    public function headings(): array
    {
        return [
            ' ',
            'user_id', //?b
            'sewa_id', //?c
            'kios_id', //?d
            'lokasi_id', //?e
            'nama_penyewa', //?f
            'nik', //?g
            'no_rekening', //?h
            'lokasi', //?i
            'tarif_dasar_kwh', //?j
            'tarif_kios', //?k
            'periode', //?l
            'keterangan', //?m
            'use_plts', //?n
            'total_kwh', //?o
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => [
                'bold' => true,
                'size' => 13
            ]],
        ];
    }

    public static function afterSheet(AfterSheet $event)
    {
        try {
            // Inisialisasi semua column untuk dilock
            $workSheet = $event
                ->sheet
                ->getProtection()
                ->setSheet(true);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('B')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('C')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('D')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('E')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('J')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('K')
                ->setVisible(false);
            // Unlock Column untuk diisi
            $workSheet = $event
                ->sheet
                ->getStyle('O')
                ->getProtection()
                ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
