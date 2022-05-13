<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeRate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RateController extends Controller
{
    public function index()
    {
        return View('pages.dashboard.admin.rates.index', [
            'title' => 'Tarif Kios',
            'rates' => TypeRate::all()
        ]);
    }

    public function create()
    {
        return View('pages.dashboard.admin.rates.createRate', [
            'title' => "Create Rate"
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => "required|max:255",
            'price' => "required|numeric",
        ]);

        TypeRate::create($validatedData);

        Alert::toast('Rate berhasil di Tambah!','success');
        return redirect('dashboard/rate');
    }

    public function show($id)
    {
        //
    }


    public function edit(TypeRate $rate)
    {
        return view('pages.dashboard.admin.rates.editRate', [
            'title' => "Edit Rate",
            'rate' => $rate
        ]);
    }

    public function update(Request $request,TypeRate $rate)
    {
        $validatedData = $request->validate([
            'type' => "required|max:255",
            'price' => "required|numeric",
        ]);
        TypeRate::where('id', $rate->id)->update($validatedData);

        Alert::toast('Rate berhasil di update!','success');
        return redirect('dashboard/rate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TypeRate::destroy($id);

        Alert::toast('Rate berhasil di Hapus!','success');
        return redirect('dashboard/rate');
    }
}
