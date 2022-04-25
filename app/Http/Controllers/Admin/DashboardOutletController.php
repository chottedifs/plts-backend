<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Facade\FlareClient\View;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardOutletController extends Controller
{
    /**
     * Display a listing of t{{ he resource. }}
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.admin.outlets.index', [
            "title" => "Data Kios",
            "outlets" => Outlet::all(),
            // "users" => User::all(),
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
        return view('pages.dashboard.admin.outlets.createOutlet', [
            "title" => "Create New Outlet",
            // "users" => User::all(),
            "rates" => Rate::all()
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
            // "id_user" => "required",
            "id_rate" => "required",
            "name_kios" => "required|max:255",
            "luas_kios" => "required"
        ]);

        Outlet::create($validatedData);
        Alert::toast('Outlet berhasil ditambahkan!','success');
        return redirect('dashboard/outlet');
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
    public function edit(Outlet $outlet)
    {
        return view('pages.dashboard.admin.outlets.editOutlet', [
            "title" => "Edit Outlet",
            "outlet" => $outlet,
            // "users" => User::all(),
            "rates" => Rate::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Outlet $outlet)
    {
        // $validatedData = $request->validate([
        //     "id_user" => "required",
        //     "id_rate" => "required",
        //     "name_outlet" => "required|max:255",
        //     "luas_kios" => "required",
        //     "status_kios" => "required"
        // ]);

        // Outlet::where('id', $outlet->id)->update($validatedData);

        // Alert::toast('Outlet berhasil di update!','success');
        // return redirect('/admin/dashboard/outlet')->with('success', 'Outlet has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Outlet::destroy($id);
        // Alert::toast('Outlet telah dihapus!','warning');
        // return redirect('/admin/dashboard/outlet')->with('success', 'Outlet has been deleted!');
    }

    public function setStatusAvailable(Request $request,Outlet $outlet)
    {
        $outlet->status_kios = true;
        $outlet->save();

        Alert::toast('Status kios berhasil di update!','success');
        return redirect('dashboard/outlet');
    }

    public function setStatusNotAvailable(Request $request,Outlet $outlet)
    {
        $outlet->status_kios = false;
        $outlet->save();

        Alert::toast('Status kios berhasil di update!','success');
        return redirect('dashboard/outlet');
    }
}
