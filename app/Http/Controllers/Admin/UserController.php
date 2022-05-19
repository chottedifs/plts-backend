<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with('Lokasi')->get();
        return view('pages.admin.user.index',[
            'judul' => 'Biodata User',
            'users' => $user
        ]);

    }

    public function create()
    {
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.user.create', [
            'judul' => 'Tambah User',
            'banyakLokasi' => $banyakLokasi
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:6',
            'lokasi_id' => 'required',
            'nik' => 'required|numeric',
            'rekening' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);
        $validatedData["password"] = Hash::make($validatedData["password"]);
        $validatedData['status_user'] = true;

        User::create($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-user.index'));
        
        // // Create Data User
        // $dataUser = new DataUser();
        // $dataUser->user_id = $validatedData['id'];
        // $dataUser->nama_lengkap = $validatedData['nama_lengkap'];
        // $dataUser->nik = $validatedData['nik'];
        // $dataUser->rekening = $validatedData['rekening'];
        // $dataUser->no_hp = $validatedData['no_hp'];
        // $dataUser->jenis_kelamin = $validatedData['jenis_kelamin'];
        // $dataUser->status_user = true;
        // $dataUser->save();

        // return redirect(route('master-user.index'));
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
        $user = User::findOrFail($id);
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.user.edit', [
            'judul' => 'Edit Data User',
            'user' => $user,
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
            'nik' => 'required|numeric',
            'rekening' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);
        $validatedData["password"] = Hash::make($validatedData["password"]);//! hapus jika tidak ada update password
        $validatedData['status_user'] = true;

        $user = User::findOrFail($id);

        $user->update($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User::destroy($id);
        // return redirect(route('master-user.index'));
    }
}
