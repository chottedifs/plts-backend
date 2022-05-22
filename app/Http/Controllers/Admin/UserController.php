<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use App\Models\Login;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $user = User::with('Lokasi')->where('lokasi_id', $lokasiPetugas)->get();
        } else {
            $user = User::with('Lokasi')->get();
        }
        // $user = User::with('Lokasi')->get();
        return view('pages.admin.user.index',[
            'judul' => 'Biodata User',
            'users' => $user
        ]);

    }

    public function create()
    {
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $banyakLokasi = Lokasi::where('id', $lokasiPetugas)->get();
        } elseif($roles == "admin") {
            $banyakLokasi = Lokasi::all();
        }
        return view('pages.admin.user.create', [
            'judul' => 'Tambah User',
            'banyakLokasi' => $banyakLokasi
        ]);
    }

    public function store(Request $request)
    {
        $validatedData1 = $request->validate([
            'email' => 'required|email|unique:logins,email',
            'password' => 'required|min:6',
        ]);
        $validatedData2 = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'lokasi_id' => 'required',
            'nik' => 'required|numeric',
            'rekening' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);
        $validatedData1['password'] = bcrypt($validatedData1['password']);
        $validatedData1['roles'] = 'user';
        $validatedData1['is_active'] = true;

        $login = Login::create($validatedData1);

        $validatedData2['login_id'] = $login->id;
        User::create($validatedData2);

        // Alert::toast('Kios berhasil ditambahkan!','success');
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
        $user = User::findOrFail($id);

        // $roles = Auth::user()->roles;
        // if ($roles == "operator") {
        //     $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
        //     $banyakLokasi = Lokasi::where('id', $lokasiPetugas)->get();
        // } elseif($roles == "admin") {
        //     $banyakLokasi = Lokasi::all();
        // }
        // return view('pages.admin.user.create', [
        //     'judul' => 'Tambah User',
        //     'banyakLokasi' => $banyakLokasi
        // ]);

        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $banyakLokasi = Lokasi::where('id', $lokasiPetugas)->get();
        } elseif($roles == "admin") {
            $banyakLokasi = Lokasi::all();
        }
        
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
        $validatedData1 = $request->validate([
            'email' => 'required|email',
            'password' => '',
        ]);
        $validatedData2 = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'lokasi_id' => 'required',
            'nik' => 'required|numeric',
            'rekening' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);
        
        $user = User::findOrFail($id);
        // $login = Login::where('id', $user->login_id)->get();
        $passwordLama = $user->Login->password;
        if ($validatedData1['email'] != $user->Login->email) {
            $validatedData1 = $request->validate([
                'email' => 'required|email|unique:logins,email'
            ]);
        } else {
            $validatedData1['email'] = $user->Login->email;
        }

        if ($validatedData1["password"] != null) {
            $validatedData1 = $request->validate([
                'password' => 'required|min:6',
            ]);
            $validatedData1['password'] = bcrypt($validatedData1['password']);
        } else {
            $validatedData1['password'] = $passwordLama;
        }

        $user->Login->update($validatedData1);

        $validatedData2['login_id'] = $user->login_id;
        $user->update($validatedData2);

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
