<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Tagihan;
use App\Exports\TagihanExport;
use App\Exports\ReportTagihanExport;
use App\Imports\TagihanImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $bulanTagihan = request()->bulanTagihan;
        if ($request->bulanTagihan) {
            $bulan = $request->bulanTagihan;
            $bulanP = explode('-', $bulan);
            $roles = Auth::user()->roles;
            if ($roles == "plts") {
                $lokasiPlts = Auth::user()->Plts->lokasi_id;
                $dataTahun = Tagihan::whereYear('periode', $bulanP[0]);
                $dataBulan = $dataTahun->whereMonth('periode', $bulanP[1]);
                $dataTagihan = $dataBulan->where('lokasi_id', $lokasiPlts)->get();
            } elseif ($roles == "admin") {
                $dataTahun = Tagihan::whereYear('periode', $bulanP[0]);
                $dataTagihan = $dataTahun->whereMonth('periode', $bulanP[1])->get();
            }
        } else {
            $bulan = Carbon::now()->format('Y-m');
            $bulanP = explode('-', $bulan);
            $roles = Auth::user()->roles;
            if ($roles == "plts") {
                $lokasiPlts = Auth::user()->Plts->lokasi_id;
                $dataTahun = Tagihan::whereYear('periode', $bulanP[0]);
                $dataBulan = $dataTahun->whereMonth('periode', $bulanP[1]);
                $dataTagihan = $dataBulan->where('lokasi_id', $lokasiPlts)->get();
            } elseif ($roles == "admin") {
                $dataTahun = Tagihan::whereYear('periode', $bulanP[0]);
                $dataTagihan = $dataTahun->whereMonth('periode', $bulanP[1])->get();
            }
        }

        return view('pages.admin.tagihan.index', [
            'judul' => 'Tagihan Penyewa Kios',
            'dataTagihan' => $dataTagihan,
            'periode' => $bulan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('plts');
        // $sheet->setCell('B')->setHidden();
        return Excel::download(new TagihanExport, 'template-tagihan'.time().'.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import(Request $request)
    {
        $this->authorize('plts');
        $file = $request->file('import-file');

        $namaFile = $file->getClientOriginalName();

        $file->move('uploads-tagihan', $namaFile);

        // import data
        $import = Excel::import(new TagihanImport, public_path('/uploads-tagihan/'.$namaFile));

        if($import) {
            //redirect
            Alert::toast('Data berhasil diimport!','success');
            return redirect(route('tagihan-index'));
        } else {
            //redirect
            Alert::toast('Data gagal diimport!','warning');
            return redirect(route('tagihan-index'));
        }
    }

    public function export()
    {
        return Excel::download(new ReportTagihanExport, 'report-tagihan'.time().'.xlsx');
    }
}
