<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use App\Models\User;
use App\Models\Outlet;
use App\Models\Tagihan;
use App\Models\TypeRate;
use App\Imports\TagihanImport;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with('Outlet')->get();
        return view('pages.dashboard.admin.tagihan.index',[
            'title' => 'Tagihan Kios',
            'tagihans' => $tagihans
        ]);
    }

    public function create()
    {
        $outlet = Outlet::all();
        return view('pages.dashboard.admin.tagihan.create',[
            'title' => 'Tambah Tagihan Kios',
            'outlets' => $outlet
        ]);
    }

    public function store(Request $request)
    {
        $rate = TypeRate::where('id', $request['outlet_id'])->first();
        $validateData = $request->validate([
            'outlet_id' => 'required',
            'nilai_kwh_awal' => 'required|integer',
            'nilai_kwh_akhir' => 'required|integer',
            'total_kwh' => 'required|integer',
            'periode' => 'required|date'
        ]);

        $validateData['jumlah_tagihan'] = $rate->price*$validateData['total_kwh'];
        $validateData['status_pembayaran'] = false;

        Tagihan::create($validateData);
        return redirect( route('tagihan.index') );
    }

    public function show($id)
    {
        //
    }

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

    public function import(Request $request){
        Excel::import(new TagihanImport, $request->file('file')->store('files'));
        return redirect()->back();
    }
}
