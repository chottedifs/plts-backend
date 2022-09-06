<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function all()
    {
        $informations = Informasi::all();

        if ($informations)
            return ResponseFormatter::success($informations, 'Data Informasi Berhasil di Ambil');
        else
            return ResponseFormatter::error(null, 'Data Informasi Tidak Ada', 404);
    }
}
