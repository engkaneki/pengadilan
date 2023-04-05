<?php

namespace App\Http\Controllers;

use App\Models\ModelPengadilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengadilanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pengadilan.dashboard')->with([
            'user' => $user,
        ]);
    }

    public function pengajuan()
    {
        $user = Auth::user();
        $data = [
            'Berkas' => ModelPengadilan::all()
        ];
        return view('pengadilan.pengajaun', $data)->with([
            'user' => $user,
        ]);
    }
}
