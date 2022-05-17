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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relasiDataKios = RelasiKios::all();
        return view('pages.admin.relasiKios.index', [
            'judul' => 'Relasi Data Kios',
            'relasiDataKios' => $relasiDataKios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banyakKios = Kios::all();
        $banyakTarifKios = TarifKios::all();
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.relasiKios.create', [
            'judul' => 'Menentukan Data Kios',
            'banyakKios' => $banyakKios,
            'banyakTarifKios' => $banyakTarifKios,
            'banyakLokasi' => $banyakLokasi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kios_id' => 'required',
            'tarif_kios_id' => 'required',
            'lokasi_id' => 'required',
        ]);
        // ddd($validatedData['kios_id']);
        $updateAktifKios['status_kios'] = true;
        $validatedData['status_relasi_kios'] = true;
        Kios::where('id', $validatedData['kios_id'])->update($updateAktifKios);
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
}
