<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kios;
// use RealRashid\SweetAlert\Facades\Alert;

class KiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banyakKios = Kios::all();
        return view('pages.admin.kios.index', [
            'judul' => 'Kios',
            'banyakKios' => $banyakKios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.kios.create', [
            'judul' => "Tambah Kios"
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
            'nama_kios' => 'required|max:255',
            'luas_kios' => 'required'
        ]);
        $validatedData['status_kios'] = true;
        Kios::create($validatedData);

        // Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('master-kios.index'));
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
        $kios = Kios::findOrFail($id);
        return view('pages/admin/kios/edit', [
            'judul' => 'Edit Kios',
            'kios' => $kios
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
            'nama_kios' => 'required|max:255',
            'luas_kios' => 'required'
        ]);

        $data = $request->all();

        $kios = Kios::findOrFail($id);
        $kios->update($data);
        return redirect(route('master-kios.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Kios::destroy($id);
        // return redirect(route('master-kios.index'));
    }
}
