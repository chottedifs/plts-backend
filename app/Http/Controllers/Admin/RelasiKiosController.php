<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Lokasi;
use App\Models\RelasiKios;
use App\Models\TarifKios;
use Illuminate\Http\Request;

class RelasiKiosController extends Controller
{
    public function index()
    {
        $relasiDataKios = RelasiKios::with('Kios','Lokasi','TarifKios')->get();
        return view('pages.admin.relasiKios.index', [
            'judul' => 'Data Kios',
            'relasiDataKios' => $relasiDataKios
        ]);
    }

    public function create()
    {
        $banyakKios = Kios::all();
        $banyakTarifKios = TarifKios::all();
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.relasiKios.create', [
            'judul' => 'Tambah Data Kios',
            'banyakKios' => $banyakKios,
            'banyakTarifKios' => $banyakTarifKios,
            'banyakLokasi' => $banyakLokasi
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kios_id' => 'required',
            'tarif_kios_id' => 'required',
            'lokasi_id' => 'required',
        ]);
        // ddd($validatedData['kios_id']);
        // $validatedData['status_kios'] = true;
        $validatedData['status_relasi_kios'] = false;
        Kios::where('id', $validatedData['kios_id']);
        RelasiKios::create($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-relasiKios.index'));
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
        $dataRelasiKios = RelasiKios::findOrFail($id);
        $dataLokasi = Lokasi::all();
        $dataTarifKios = TarifKios::all();
        $dataKios = Kios::all();
        return view('pages.admin.relasiKios.edit', [
            'judul' => 'Edit Data Kios',
            'dataRelasiKios' => $dataRelasiKios,
            'dataKios' => $dataKios,
            'dataTarifKios' => $dataTarifKios,
            'dataLokasi' => $dataLokasi,
        ]);
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
        $validatedData = $request->validate([
            'kios_id' => 'required',
            'tarif_kios_id' => 'required',
            'lokasi_id' => 'required',
        ]);
        //! membuat kios sebelumnya tidak aktif
        $validatedData['status_relasi_kios'] = false;
        Kios::where('id', $validatedData['kios_id']);
        RelasiKios::create($validatedData);
        return redirect(route('master-relasiKios.index'));
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
}
