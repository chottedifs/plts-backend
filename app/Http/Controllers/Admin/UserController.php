<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.admin.user.dashboard',[
            "title" => "Data User",
            "users" => User::all()
        ]);
    }


    // public function create()
    // {
    //     return view('pages.dashboard.user.createUser', [
    //         "title" => "Create New User",
    //         "outlets" => Outlet::all()
    //     ]);
    // }


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => ['required','max:255'],
    //         'email' => ['required','email','max:255'],
    //         'phone_number' => ['required','numeric','min:10'],
    //         'id_outlet' => ['required']
    //     ]);

    //     $validatedData["password"] = Hash::make("kiosunpam");
    //     $validatedData["id_tagihan"] = 2;
    //     $validatedData["roles"] = "user";
    //     $validatedData["is_active"] = 1;

    //     $outletStatus["status_kios"] = true;
    //     Outlet::where('id', $validatedData["id_outlet"])->update($outletStatus);
    //     User::create($validatedData);

    //     Alert::toast('User berhasil ditambahkan!','success');
    //     return redirect('dashboard/user');
    // }


    // public function show($id)
    // {
    //     //
    // }

    // public function edit(User $user)
    // {
    //     return view("pages.dashboard.user.editUser",[
    //         "title" => "Edir User",
    //         "user" => $user,
    //         "outlets" => Outlet::all()
    //     ]);
    // }


    // public function update(Request $request, User $user)
    // {
    //     $validatedData = $request->validate([
    //         'name' => ['required','max:255'],
    //         'email' => ['required','email','max:255'],
    //         'phone_number' => ['required','numeric','min:10'],
    //         'id_outlet' => ['required']
    //     ]);

    //     $validatedData["password"] = $user->password;
    //     $validatedData["id_tagihan"] = $user->id_tagihan;
    //     $validatedData["roles"] = $user->roles;
    //     $validatedData["is_active"] = $user->is_active;

    //     // membuat kios sebelumnya di false
    //     if($validatedData["id_outlet"] != $user->id_outlet){
    //         // ddd($validatedData["id_outlet"] ."|". $user->id_outlet);
    //         $outletStatus["status_kios"] = false;
    //         Outlet::where('id', $user->id_outlet)->update($outletStatus);
    //     }
    //     User::where('id', $user->id)->update($validatedData);
    //     $outletStatus["status_kios"] = true;
    //     Outlet::where('id', $validatedData["id_outlet"])->update($outletStatus);
    //     Alert::toast('User berhasil diUpdate!','success');
    //     return redirect('dashboard/user');
    // }


    // public function destroy(User $user)
    // {
    //     User::destroy($user->id);
    //     $outletStatus["status_kios"] = false;
    //     Outlet::where('id', $user->id_outlet)->update($outletStatus);
    //     Alert::toast('Outlet telah dihapus!','warning');
    //     return redirect('/dashboard/user');
    // }
}
