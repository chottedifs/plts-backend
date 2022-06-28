<?php

namespace App\Exports;

use App\Models\SewaKios;
use App\Models\User;
use App\Models\TarifKwh;
use App\Models\Petugas;
use App\Models\Tagihan;
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

class TagihanExportDiskon implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithStyles
{
    use RegistersEventListeners;

    public function collection()
    {
        $login = Auth::user();
        if ($login->roles == "admin") {
            // ddd($sewaKios[0]->id);
            $tagihan = Tagihan::with('SewaKios')->where('status_id', 1)->get();
            // $lokasiPlts = Auth::user()->Plts->lokasi_id;
            // // $lokasiKios = RelasiKios::with('Lokasi')->where('lokasi_id', $lokasiPlts)->get();
            // $tagihan = tagihan::with('RelasiKios')->where([
            //     'lokasi_id' => $lokasiPlts,
            //     'status_sewa' => 1
            //     ])->get();
            // // $tagihan = tagihan::with('RelasiKios')->get();
        } elseif ($login->roles == "operator") {
            $petugas = Petugas::where('login_id', $login->id)->get();
            // $tagihan = Tagihan::with('RelasiKios', 'User')->where(['status_sewa' => 1, 'lokasi_id' => $petugas[0]->lokasi_id])->get();
            $tagihan = Tagihan::with('SewaKios')->where([
                'status_id' => 1,
                'lokasi_id' => $petugas[0]->lokasi_id
            ])->get();
        }
        // elseif ($roles == "admin") {
        //     $tagihan = tagihan::with('RelasiKios')->where('status_sewa', 1)->get();
        // }

        return $tagihan;
    }

    public function map($tagihan): array
    {
        $tarif_dasar = TarifKwh::select('harga')->first();
        $tanggal = date('M Y');

        // ddd($tarif_dasar);
        return [
            $tagihan->sewa_kios_id,
            // $tagihan->RelasiKios->Kios->nama_kios,
            // $tagihan->User->id,
            // $tagihan->id,
            // $tagihan->RelasiKios->Kios->id,
            // $tagihan->lokasi_id,
            // $tagihan->User->nama_lengkap,
            // $tagihan->User->rekening,
            // $tagihan->Lokasi->nama_lokasi,
            // $tarif_dasar->harga,
            // $tagihan->RelasiKios->TarifKios->harga,
            // $tanggal,
            // $tagihan->Tagihan->total_kwh
        ];
    }

    public function headings(): array
    {
        return [
            ' ',
            'user_id',
            'sewa_id',
            'kios_id',
            'lokasi_id',
            'nama_penyewa',
            'no_rekening',
            'lokasi',
            'tarif_dasar_kwh',
            'tarif_kios',
            'periode',
            'total_kwh',
            'diskon'
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
                ->getColumnDimension('H')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('I')
                ->setVisible(false);

            // Hide Column yang tidak diperlukan
            $workSheet = $event
                ->sheet
                ->getColumnDimension('J')
                ->setVisible(false);

            // Unlock Column untuk diisi
            $workSheet = $event
                ->sheet
                ->getStyle('M')
                ->getProtection()
                ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
