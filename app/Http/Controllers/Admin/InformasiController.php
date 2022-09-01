<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class InformasiController extends Controller
{
    public function index()
    {
        $informations = Informasi::all();
        return view('pages.admin.informasi.index', [
            'judul' => 'Master Data Informasi',
            'informasi' => $informations
        ]);
    }

    public function create()
    {
        $informations = Informasi::all();
        return view('pages.admin.informasi.create', [
            'judul' => 'Tambah Master Data Informasi',
            'informasi' => $informations
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,png|max:1000',
        ]);
        $validatedData['gambar'] = $request->file('gambar')->store('public/images/informasi');
        Informasi::create($validatedData);

        Alert::toast('Data informasi berhasil ditambahkan!', 'success');
        return redirect(route('master-informasi.index'));
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
        $informations = Informasi::findOrFail($id);
        return view('pages.admin.informasi.edit', [
            'judul' => 'Edit Master Data Informasi',
            'informasi' => $informations
        ]);
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
        ]);
        if ($request->file('gambar')) {
            $validatedData = $request->validate(['gambar' => 'mimes:jpg,jpeg,png|max:1000']);
            Storage::delete($informasi->gambar);
            $validatedData['gambar'] = $request->file('gambar')->store('public/images/informasi');
            // $validatedData['image'] = $request->file('image')->store('public/images/infografis');
        }
        // $informations = Informasi::findOrFail($id);
        $informasi->update($validatedData);

        Alert::toast('Data informasi berhasil diupdate!', 'success');
        return redirect(route('master-informasi.index'));
    }

    public function destroy($id)
    {
        $informations = Informasi::findOrFail($id);
        Storage::delete($informations->image);
        Informasi::destroy($informations->id);
        // $informations->delete();

        Alert::toast('Data informasi berhasil dihapus!', 'success');
        return redirect(route('master-informasi.index'));
    }
}
