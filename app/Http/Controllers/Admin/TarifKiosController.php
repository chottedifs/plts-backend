<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TarifKios;

class TarifKiosController extends Controller
{
    public function index()
    {
        $tarifKios = TarifKios::all();
        return view('pages.admin.tarifKios.index', [
            'judul' => 'Master Data Tarif Kios',
            'tarifKios' => $tarifKios
        ]);
    }

    public function create()
    {
        $tarifKios = TarifKios::all();
        return view('pages.admin.tarifKios.create', [
            'judul' => 'Tambah Master Data Tarif Kios',
            'tarifKios' => $tarifKios
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipe' => 'required|max:255',
            'harga' => 'required|numeric'
        ]);

        TarifKios::create($validatedData);
        return redirect(route('tarifKios.index'));
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
