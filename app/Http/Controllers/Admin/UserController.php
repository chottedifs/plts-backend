<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with('DataUser')->get();
        return view('pages.admin.user.index',[
            'judul' => 'Biodata User',
            'users' => $user
        ]);

    }

    public function create()
    {
        return view('pages.admin.user.create', [
            'judul' => 'Tambah User'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required',
            'password' => 'required',
            'rekening' => 'required',
            'no_hp' => 'required',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['status_user'] = true;
        User::create($validatedData);
        
        // Create Data User
        $dataUser = new DataUser();
        $dataUser->user_id = $validatedData['id'];
        $dataUser->nama_lengkap = $validatedData['nama_lengkap'];
        $dataUser->nik = $validatedData['nik'];
        $dataUser->rekening = $validatedData['rekening'];
        $dataUser->no_hp = $validatedData['no_hp'];
        $dataUser->jenis_kelamin = $validatedData['jenis_kelamin'];
        $dataUser->status_user = true;
        $dataUser->save();

        return redirect(route('master-user.index'));
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
