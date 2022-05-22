<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Lokasi;
use App\Models\RelasiKios;
use App\Models\TarifKios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelasiKiosController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $relasiDataKios = RelasiKios::with('Kios','Lokasi','TarifKios')->where('lokasi_id', $lokasiPetugas)->get();
        } elseif ($roles == "admin") {
            $relasiDataKios = RelasiKios::with('Kios','Lokasi','TarifKios')->get();
        }
        // $relasiDataKios = RelasiKios::with('Kios','Lokasi','TarifKios')->get();
        return view('pages.admin.relasiKios.index', [
            'judul' => 'Data Kios',
            'relasiDataKios' => $relasiDataKios
        ]);
    }

    public function create()
    {
        $this->authorize('admin');
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
        $this->authorize('admin');
        $validatedData = $request->validate([
            'kios_id' => 'required',
            'tarif_kios_id' => 'required',
            'lokasi_id' => 'required',
        ]);
        // ddd($validatedData['kios_id']);
        $validatedData['status_relasi_kios'] = false;
        RelasiKios::create($validatedData);

        $status = Kios::findOrFail($validatedData['kios_id']);
        $status['status_kios'] = true;
        $status->update();

        // $affected = Kios::table('users')
        //             ->where('id', 1)
        //             ->update(['votes' => 1]);

        // Update Status Kios
        // $status = new Kios();


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
        $this->authorize('admin');
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
    public function update(Request $request,$id)
    {
        $this->authorize('admin');
        $dataRelasiKios = RelasiKios::findOrFail($id);
        $validatedData = $request->validate([
            'kios_id' => 'required',
            'tarif_kios_id' => 'required',
            'lokasi_id' => 'required',
        ]);
        // membuat kios sebelumnya tidak aktif
        $status = Kios::findOrFail($dataRelasiKios->kios_id);
        if($validatedData['kios_id'] != $status->id){
            $status['status_kios'] = false;
            $status->update();
            // kios yang baru di pilih
            $status = Kios::findOrFail($validatedData['kios_id']);
            $status['status_kios'] = true;
            $status->update();
        }

        $validatedData['status_relasi_kios'] = $dataRelasiKios->status_relasi_kios;
        // $validatedData['status_relasi_kios']->update();
        $dataRelasiKios->update($validatedData);


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
