<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class UserKiosController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.dashboard.admin.user.index',[
            'title' => 'Data Pengguna Kios',
            'users' => $users
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('pages.dashboard.admin.user.createUser',[
            'title' => 'Tambah Data Pengguna Kios',
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|numeric|min:14'
        ]);

        $validateData['password'] = Hash::make('kiosunpam');
        $validateData['roles'] = 'user';
        $validateData['is_active'] = true;
        User::create($validateData);

        Alert::toast('User berhasil ditambahkan!','success');
        return redirect(route('user-kios.index'));
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('pages.dashboard.admin.user.editUser',[
            'title' => 'Edit Data Pengguna Kios',
            'users' => $users
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $users = User::findOrFail($id);
        $users->update($data);
        return redirect(route('user-kios.index'));
    }
}
