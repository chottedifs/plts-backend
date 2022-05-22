<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RelasiKios;
use App\Models\SewaKios;
use App\Models\HistoriKios;
use Illuminate\Support\Facades\Auth;

class sewaKiosController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->roles;
        if ($roles == "operator") {
            $lokasiPetugas = Auth::user()->Petugas->lokasi_id;
            $sewaKios = SewaKios::with('RelasiKios')->where('relasi_kios_id', $lokasiPetugas)->get();
        } elseif ($roles == "admin") {
            $sewaKios = SewaKios::with('RelasiKios')->get();
        }

        // $sewaKios = SewaKios::with('RelasiKios','User')->get();
        return view('pages.admin.sewaKios.index', [
            'judul' => 'Sewa Kios',
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
            // $banyakLokasi = Lokasi::all();
        }

        // $user = User::all();
        // $relasiKios = RelasiKios::with('Kios')->get();
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
            'relasi_kios_id' => 'required'
        ]);
        $statusRelasiKios = RelasiKios::findOrFail($validatedData['relasi_kios_id']);
        $statusRelasiKios['status_relasi_kios'] = true;
        $statusRelasiKios->update();

        $validatedData['status_sewa'] = true;
        SewaKios::create($validatedData);

        // Create Histori Kios
        $histori = new HistoriKios();
        $histori->user_id = $validatedData['user_id'];
        $histori->sewa_kios_id = $validatedData['relasi_kios_id'];
        $histori->tgl_awal_sewa = date('Y-m-d');
        $histori->save();

        return redirect(route('sewa-kios.index'));
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

    public function edit($id)
    {
        $user = User::all();
        $sewaKios = SewaKios::findOrFail($id);
        $relasiDataKiosBerdasarkan = RelasiKios::findOrFail($sewaKios->relasi_kios_id);
        $relasiDataKios = RelasiKios::all();
        // $sewaKios = SewaKios::with('RelasiKios','User')->get();
        return view('pages.admin.sewaKios.edit', [
            'judul' => 'Edit Data Sewa Kios',
            'sewaKios' => $sewaKios,
            'users' => $user,
            'relasiDataKios' => $relasiDataKios,
            'relasiDataKiosBerdasarkan' => $relasiDataKiosBerdasarkan
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $sewaKios = SewaKios::findOrFail($id);
        $sewaKios->update($data);

        // Create Histori Kios
        $histori = new HistoriKios();
        $histori->user_id = $data['user_id'];
        $histori->sewa_kios_id = $sewaKios['relasi_kios_id'];
        $histori->tgl_awal_sewa = date('Y-m-d H:i:s');
        $histori->save();

        return redirect(route('sewa-kios.index'));
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
