<?php

namespace App\Exports;

use App\Models\SewaKios;
use App\Models\User;
use App\Models\TarifKwh;
use App\Models\HistoriKios;
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
            $sewaKios = SewaKios::with('RelasiKios')->where('status_sewa', 1)->get();
            // $lokasiPlts = Auth::user()->Plts->lokasi_id;
            // // $lokasiKios = RelasiKios::with('Lokasi')->where('lokasi_id', $lokasiPlts)->get();
            // $sewaKios = SewaKios::with('RelasiKios')->where([
            //     'lokasi_id' => $lokasiPlts,
            //     'status_sewa' => 1
            //     ])->get();
            // // $historiKios = HistoriKios::with('SewaKios')->where('sewa_kios_id',$sewaKios->id)->get();
            // // $sewaKios = SewaKios::with('RelasiKios')->get();
        }
        // elseif ($roles == "admin") {
        //     $sewaKios = SewaKios::with('RelasiKios')->where('status_sewa', 1)->get();
        // }

        return $sewaKios;
    }

    public function map($sewaKios): array
    {
        $historiKios = HistoriKios::with('SewaKios')->where('user_id', $sewaKios->user_id)->first();
        $tarif_dasar = TarifKwh::select('harga')->first();
        $tanggal = date('M Y');

        // ddd($tarif_dasar);
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
            'sewa_id',
            'kios_id',
            'histori_id',
            'lokasi_id',
            'nama_penyewa',
            'lokasi',
            'tarif_dasar_kwh',
            'tarif_kios',
            'periode',
            'total_kwh',
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
                ->getColumnDimension('F')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('G')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('H')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('I')
                ->setVisible(false);

            // Unlock Column untuk diisi
            // $workSheet = $event
            // ->sheet
            // ->getStyle('K')
            // ->getProtection()
            // ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
