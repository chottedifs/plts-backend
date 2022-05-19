<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banyakPetugas = Petugas::with('lokasi')->get();
        return view('pages.admin.petugas.index', [
            'judul' => 'Data Petugas',
            'banyakPetugas' => $banyakPetugas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.petugas.create', [
            'judul' => 'Tambah Data Petugas',
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
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:6',
            'lokasi_id' => 'required',
            'nip' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);
        $validatedData["password"] = Hash::make($validatedData["password"]);
        $validatedData['status_petugas'] = true;

        Petugas::create($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-petugas.index'));
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
        $petugas = Petugas::findOrFail($id);
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.petugas.edit', [
            'judul' => 'Edit Data Petugas',
            'petugas' => $petugas,
            'banyakLokasi' => $banyakLokasi
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
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:6',//! apakah sekaligus bisa update password
            'lokasi_id' => 'required',
            'nip' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);
        $validatedData["password"] = Hash::make($validatedData["password"]);//! hapus jika tidak ada update password
        $validatedData['status_petugas'] = true;

        $petugas = Petugas::findOrFail($id);

        $petugas->update($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-petugas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Petugas::destroy($id);
        // return redirect(route('master-petugas.index'));
    }
}
