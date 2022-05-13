<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facade\FlareClient\View;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\TypeRate;
use App\Models\Outlet;
use Auth;

class DashboardOutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::with('Typerate','User')->get();
        return view('pages.dashboard.admin.outlets.index', [
            'title' => "Data Kios",
            'outlets' => $outlets
        ]);
    }

    public function create()
    {
        $users = User::all();
        $tipe = TypeRate::all();
        return view('pages.dashboard.admin.outlets.createOutlet', [
            'title' => 'Tambah Kios',
            'users' => $users,
            'rates' => $tipe
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'type_rate_id' => 'required',
            'name_kios' => 'required',
            'luas_kios' => 'required'
        ]);

        // $validateData['status_kios'] = true;
        Outlet::create($validatedData);

        Alert::toast('Kios berhasil ditambahkan!','success');
        return redirect(route('outlet.index') );
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kios = Outlet::findOrFail($id);
        $users = User::all();
        $typerate = Typerate::all();
        return view('pages.dashboard.admin.outlets.editOutlet', [
            'title' => 'Edit Outlet',
            'kios' => $kios,
            'users' => $users,
            'typerates' => $typerate
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
                // 'user_id' => 'required',
                // 'type_rate_id' => 'required',
                'name_kios' => 'required|max:255',
                'luas_kios' => 'required',
        ]);
        $data = $request->all();

        $users = Outlet::findOrFail($id);
        $users->update($data);

        Alert::toast('Kios berhasil diupdate!','success');
        return redirect(route('outlet.index'));
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
