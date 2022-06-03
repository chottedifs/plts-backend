<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TagihanExport;
use App\Imports\TagihanImport;
use App\Http\Controllers\Controller;
use App\Models\SewaKios;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            // $lokasiKios = RelasiKios::with('Lokasi')->where('lokasi_id', $lokasiPetugas)->get();
            $dataTagihan = Tagihan::with('SewaKios','HistoriKios')->where('lokasi_id', $lokasiPetugas)->get();
            // $sewaKios = SewaKios::with('RelasiKios')->get();
        } elseif ($roles == "admin") {
            $dataTagihan = Tagihan::with('SewaKios','HistoriKios')->get();
        }

        // $sewaKios = SewaKios::with('RelasiKios','User')->get();
        // ddd($sewaKios);

        return view('pages.admin.tagihan.index', [
            'judul' => 'Tagihan Penyewa Kios',
            'dataTagihan' => $dataTagihan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Excel::download(new TagihanExport, 'templateExportTagihan.xlsx');
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
        // $request->validate([
        //     'file'=> 'required|mimes:xlsx'
        // ]);

        $file = $request->file('import-file');

        $namaFile = $file->getClientOriginalName();

        $file->move('excel', $namaFile);

        // //temporary file
        // $path = $file->store('public/excel/',$nama_file);

        // ddd($path);

        // import data
        $import = Excel::import(new TagihanImport, public_path('/excel/'.$namaFile));

        //remove from server
        // Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('tagihan-index')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('tagihan-index')->with(['error' => 'Data Gagal Diimport!']);
        }


        // Excel::import(new TagihanImport, 'templateExportTagihan.xlsx');

        // return redirect(route('tagihan-index'));
    }
}
