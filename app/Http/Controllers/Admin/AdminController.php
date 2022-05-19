<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banyakAdmin = Admin::with('lokasi')->get();
        return view('pages.admin.admin.index', [
            'judul' => 'Data Admin',
            'banyakAdmin' => $banyakAdmin
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
        return view('pages.admin.admin.create', [
            'judul' => 'Tambah Data Admin',
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
        $validatedData['status_admin'] = true;

        Admin::create($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-admin.index'));
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
        $admin = Admin::findOrFail($id);
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.admin.edit', [
            'judul' => 'Edit Data Admin',
            'admin' => $admin,
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

        $admin = Admin::findOrFail($id);

        $admin->update($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Admin::destroy($id);
        // return redirect(route('master-admin.index'));
    }
}
