<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RelasiKios;
use App\Models\SewaKios;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class sewaKiosController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $sewaKios = SewaKios::with('RelasiKios')->where('lokasi_id', $lokasiPetugas)->get();
        } elseif ($roles == "admin") {
            $sewaKios = SewaKios::with('RelasiKios')->get();
        }

        return view('pages.admin.sewaKios.index', [
            'judul' => 'Data Sewa Kios',
            'sewaKios' => $sewaKios,
        ]);
    }

    public function create()
    {

        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $user = User::with('Lokasi')->where('lokasi_id', $lokasiPetugas)->get();
            $relasiKios = RelasiKios::with('Kios','Lokasi')->where('lokasi_id', $lokasiPetugas)->get();
        } elseif($roles == "admin") {
            $user = User::all();
            $relasiKios = RelasiKios::with('Kios')->get();
        }

        return view('pages.admin.sewaKios.create', [
            'judul' => 'Sewa Kios',
            'relasiDataKios' => $relasiKios,
            'users' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'relasi_kios_id' => 'required',
            'tgl_sewa' => 'required'
        ]);
        $statusRelasiKios = RelasiKios::findOrFail($validatedData['relasi_kios_id']);

        $validatedData['status_sewa'] = true;
        $validatedData['lokasi_id'] = $statusRelasiKios['lokasi_id'];
        $sewa = SewaKios::create($validatedData);

        $statusRelasiKios['status_relasi_kios'] = true;
        $statusRelasiKios->update();

        Alert::toast('Data penyewa kios berhasil ditambahkan!','success');
        return redirect(route('sewa-kios.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sewaKios = SewaKios::findOrFail($id);
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $user = User::with('Lokasi')->where('lokasi_id', $lokasiPetugas)->get();
            $relasiKios = RelasiKios::with('Kios','Lokasi')->where('lokasi_id', $lokasiPetugas)->get();
        } elseif($roles == "admin") {
            $user = User::all();
            $relasiKios = RelasiKios::with('Kios')->get();
        }

        return view('pages.admin.sewaKios.edit', [
            'judul' => 'Edit Data Sewa Kios',
            'sewaKios' => $sewaKios,
            'users' => $user,
            'relasiKios' => $relasiKios,
        ]);
    }

    public function update(Request $request, $id)
    {
        $sewaKios = SewaKios::findOrFail($id);

        // Validasi Input
        $validatedData = $request->validate([
            'user_id' => 'required',
            'relasi_kios_id' => 'required',
        ]);

        $statusRelasiKios = RelasiKios::findOrFail($validatedData['relasi_kios_id']);

        if ($validatedData['user_id'] != $sewaKios->user_id){
            if ($validatedData['relasi_kios_id'] != $sewaKios->relasi_kios_id) {
                $validatedData = $request->validate([
                    'user_id' => 'required',
                    'relasi_kios_id' => 'required'
                ]);
            } else {
                // jika relasi kios sama dengan relasi kios di $sewaKios
                $validatedData = $request->validate([
                    'user_id' => 'required',
                    'relasi_kios_id' => 'required',
                ]);
                $validatedData['tgl_akhir_sewa'] = date('Y-m-d');
                $sewaKios->update($validatedData);
                // $validatedData['relasi_kios_id'] = $sewaKios->relasi_kios_id;
                // $validatedData['lokasi_id'] = $statusRelasiKios['lokasi_id'];
                // $validatedData['tgl_sewa'] = date('Y-m-d');
                // $validatedData['status_sewa'] = true;
                // $sewa = SewaKios::create($validatedData);
            }
        } elseif ($validatedData['relasi_kios_id'] != $sewaKios->relasi_kios_id) {
            $validatedData = $request->validate([
                'relasi_kios_id' => 'required'
            ]);
            $validatedData['tgl_sewa'] = date('d-m-Y');
            $sewaKios->update($validatedData);
        } else {
            Alert::toast('Data penyewa kios tidak ada yang di Update!','success');
            return redirect(route('sewa-kios.index'));
        }

        Alert::toast('Data penyewa kios berhasil diupdate!','success');
        return redirect(route('sewa-kios.index'));
    }

    public function destroy($id)
    {
        //
    }

    public function isActive($id)
    {
        $kios = SewaKios::findOrFail($id);
        if ($kios->status_sewa == 1) {
            $active['status_sewa'] = 0;
            $kios->update($active);

            Alert::toast('Data sewa kios berhasil di Non-aktifkan!','success');
            return redirect(route('sewa-kios.index'));
        } elseif ($kios->status_sewa == 0) {
            $active['status_sewa'] = 1;
            $kios->update($active);

            Alert::toast('Data sewa kios berhasil di aktifkan!','success');
            return redirect(route('sewa-kios.index'));
        }
    }
}
