<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('pages.dashboard.admin.rates.index', [
            "title" => "Rates",
            "rates" => Rate::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('pages.dashboard.admin.rates.createRate', [
            "title" => "Create Rate"
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
            "type" => "required|max:255",
            "price" => "required|numeric",
        ]);

        Rate::create($validatedData);

        Alert::toast('Rate berhasil di Tambah!','success');
        return redirect('/admin/dashboard/rate');
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
    public function edit(Rate $rate)
    {
        return view('pages.dashboard.admin.rates.editRate', [
            "title" => "Edit Rate",
            "rate" => $rate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Rate $rate)
    {
        $validatedData = $request->validate([
            "type" => "required|max:255",
            "price" => "required|numeric",
        ]);
        Rate::where('id', $rate->id)->update($validatedData);

        Alert::toast('Rate berhasil di update!','success');
        return redirect('/admin/dashboard/rate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rate::destroy($id);

        Alert::toast('Rate berhasil di Hapus!','success');
        return redirect('/admin/dashboard/rate');
    }
}
