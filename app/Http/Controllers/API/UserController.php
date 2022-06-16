<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\SewaKios;
use App\Models\RelasiKios;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
// use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = Auth::user();
        // ddd($user->email);
        $users = User::where('login_id', $login->id)->get();
        // $sewa = RelasiKios::where('user_id', $login->User->id)->get();
        $sewaKios = SewaKios::with('Tagihan')->where('user_id', $users[0]->id)->get();
        // $tagihan = Tagihan::with('SewaKios')->where('sewa_kios_id', $sewaKioss[0]->id)->get();

        return response()->json([
            'message' => 'sukses',
            // 'user' => $users,
            // 'tagihan' => $sewaKioss['tagihan'],
            'sewaKios' => $sewaKios,
            // 'sewa-kios' => $sewa,
            'keterangan' => 'halaman home'
        ], 200);
        // foreach ($sewaKios as $sewa) {
        //     return response()->json([
        //         'message' => 'sukses',
        //         // 'user' => $request->session()->get('user'),
        //         // 'tagihan' => $sewaKioss['tagihan'],
        //         'sewaKios' => $sewa->RelasiKios->Kios->nama_kios,
        //         'nama' => $sewa->User->nama_lengkap,
        //         'keterangan' => 'halaman home'
        //     ], 200);
        // }

        // $data = $request->session('token-name');

        // // $data = SewaKios::all();

        // if ($data) {
        //     return ApiFormatter::createApi(200, "Berhasil Login", $data);
        // } else {
        //     return ApiFormatter::createApi(400, "gagal Login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
