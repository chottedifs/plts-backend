<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeKwh;
use RealRashid\SweetAlert\Facades\Alert;

class KwhController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.admin.kwh.index', [
            'title' => 'Tarif Dasar Kwh',
            'rates' => TypeKwh::all()
        ]);
    }

    public function create()
    {
        return View('pages.dashboard.admin.kwh.create', [
            'title' => 'Tambah Tarif Dasar Kwh'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_tarif' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        TypeKwh::create($validatedData);

        Alert::toast('Tarif dasakwhr berhasil di Tambah!','success');
        return redirect(route('tarif-kwh.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kwhs = TypeKwh::findOrFail($id);
        return view('pages.dashboard.admin.kwh.edit', [
            'title' => 'Edit Tarif Dasar Kwh',
            'rate' => $kwhs
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = $request->validate([
            'kode_tarif' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $kwhs = TypeKwh::findOrFail($id);

        $kwhs->update($data);

        Alert::toast('Tarif dasar berhasil di update!','success');
        return redirect(route('tarif-kwh.index'));
    }

    public function destroy($id)
    {
        //
    }
}
