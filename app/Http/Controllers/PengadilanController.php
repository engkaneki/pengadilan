<?php

namespace App\Http\Controllers;

use App\Models\ModelPengadilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class PengadilanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $namaBulanTahun = $now->locale('id')->format('F Y');

        return view('pengadilan.dashboard')->with([
            'user' => $user,
            'Berkas' => ModelPengadilan::paginate(5)->onEachSide('1')->fragment('berkas'),
            'namaBulanTahun' => $namaBulanTahun
        ]);
    }

    public function pengajuan(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        if (!empty($cari)) {
            $data = ModelPengadilan::sortable()
                ->where('status', '=', 'Diproses')
                ->where(function ($query) use ($cari) {
                    $query->where('berkas.nik', 'like', '%' . $cari . '%')
                        ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
                })
                ->paginate(5)->onEachSide('1')->fragment('berkas');
        } else {
            $data = ModelPengadilan::sortable()->where('status', '=', 'Diproses')->paginate(5)->onEachSide('1')->fragment('berkas');
        }


        // $data = [
        //     'Berkas' => ModelPengadilan::sortable()->paginate(5)->onEachSide('1')->fragment('berkas')
        // ];
        return view('pengadilan.pengajaun', $data)->with([
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari
        ]);
    }

    public function selesai(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        if (!empty($cari)) {
            $data = ModelPengadilan::sortable()
                ->where('status', '=', 'Selesai')
                ->where(function ($query) use ($cari) {
                    $query->where('berkas.nik', 'like', '%' . $cari . '%')
                        ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
                })
                ->paginate(5)->onEachSide('1')->fragment('berkas');
        } else {
            $data = ModelPengadilan::sortable()->where('status', '=', 'Selesai')->paginate(5)->onEachSide('1')->fragment('berkas');
        }


        // $data = [
        //     'Berkas' => ModelPengadilan::sortable()->paginate(5)->onEachSide('1')->fragment('berkas')
        // ];
        return view('pengadilan.selesai', $data)->with([
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari,
        ]);
    }

    public function ditolak(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        if (!empty($cari)) {
            $data = ModelPengadilan::sortable()
                ->where('status', '=', 'Ditolak')
                ->where(function ($query) use ($cari) {
                    $query->where('berkas.nik', 'like', '%' . $cari . '%')
                        ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
                })
                ->paginate(5)->onEachSide('1')->fragment('berkas');
        } else {
            $data = ModelPengadilan::sortable()->where('status', '=', 'Ditolak')->paginate(5)->onEachSide('1')->fragment('berkas');
        }


        // $data = [
        //     'Berkas' => ModelPengadilan::sortable()->paginate(5)->onEachSide('1')->fragment('berkas')
        // ];
        return view('pengadilan.ditolak', $data)->with([
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari,
        ]);
    }

    public function save(Request $r)
    {
        $user = Auth::user();
        $instansi = $user->name;
        $nik = $r->nik;
        $nama = $r->nama;
        $alamat = $r->alamat;


        $validateData = $r->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'ktp' => 'mimes:png,jpg,jpeg|image|max:2048',
            'kk' => 'mimes:png,jpg,jpeg|image|max:2048',
            'akta' => 'mimes:png,jpg,jpeg|image|max:2048',
        ], [
            'nik.required' => 'NIK tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'ktp.mimes' => 'File KTP harus dalam bentuk Gambar',
            'ktp.image' => 'File KTP harus dalam bentuk Gambar',
            'ktp.max' => 'File KTP anda lebih dari 2MB',
            'kk.mimes' => 'File Kartu Keluarga harus dalam bentuk Gambar',
            'kk.image' => 'File Kartu Keluarga harus dalam bentuk Gambar',
            'kk.max' => 'File Kartu Keluarga anda lebih dari 2MB',
            'akta.mimes' => 'File Akta Cerai harus dalam bentuk Gambar',
            'akta.image' => 'File Akta Cerai harus dalam bentuk Gambar',
            'akta.max' => 'File Akta Cerai anda lebih dari 2MB',
        ]);

        if ($r->hasFile('ktp')) {
            $ktp = $r->file('ktp')->store('uploads');
        } else {
            $ktp = '';
        }

        if ($r->hasFile('kk')) {
            $kk = $r->file('kk')->store('uploads');
        } else {
            $kk = '';
        }

        if ($r->hasFile('akta')) {
            $akta = $r->file('akta')->store('uploads');
        } else {
            $akta = '';
        }

        $berkas = new ModelPengadilan;
        $berkas->nik = $nik;
        $berkas->nama = $nama;
        $berkas->alamat = $alamat;
        $berkas->status = 'Diproses';
        $berkas->instansi = $instansi;
        $berkas->ktp = $ktp;
        $berkas->kk = $kk;
        $berkas->akta = $akta;
        $berkas->save();

        return redirect()->back();
    }

    public function edit(Request $r)
    {
        $id = $r->id;
        $nik = $r->nik;
        $nama = $r->nama;
        $alamat = $r->alamat;
        $ktp_old = $r->ktp;
        $kk_old = $r->kk;
        $akta_old = $r->akta;

        $validateData = $r->validate([
            'ktp' => 'mimes:png,jpg,jpeg|image|max:2048',
            'kk' => 'mimes:png,jpg,jpeg|image|max:2048',
            'akta' => 'mimes:png,jpg,jpeg|image|max:2048',
        ], [
            'ktp.mimes' => 'File KTP harus dalam bentuk Gambar',
            'ktp.image' => 'File KTP harus dalam bentuk Gambar',
            'ktp.max' => 'File KTP anda lebih dari 2MB',
            'kk.mimes' => 'File Kartu Keluarga harus dalam bentuk Gambar',
            'kk.image' => 'File Kartu Keluarga harus dalam bentuk Gambar',
            'kk.max' => 'File Kartu Keluarga anda lebih dari 2MB',
            'akta.mimes' => 'File Akta Cerai harus dalam bentuk Gambar',
            'akta.image' => 'File Akta Cerai harus dalam bentuk Gambar',
            'akta.max' => 'File Akta Cerai anda lebih dari 2MB',
        ]);

        if ($r->hasFile('ktp')) {
            $ktp = $r->file('ktp')->store('uploads');
        } else {
            $ktp = '';
        }

        if ($r->hasFile('kk')) {
            $kk = $r->file('kk')->store('uploads');
        } else {
            $kk = '';
        }

        if ($r->hasFile('akta')) {
            $akta = $r->file('akta')->store('uploads');
        } else {
            $akta = '';
        }

        $berkas = ModelPengadilan::find($id);
        $pathktp = $berkas->ktp;
        $pathkk = $berkas->kk;
        $pathakta = $berkas->akta;
        $berkas->nik = $nik;
        $berkas->nama = $nama;
        $berkas->alamat = $alamat;
        if ($ktp != null || $ktp != '') {
            Storage::delete($pathktp);
            $berkas->ktp = $ktp;
        } else {
            $berkas->ktp = $pathktp;
        }
        if ($kk != null || $kk != '') {
            Storage::delete($pathkk);
            $berkas->kk = $kk;
        } else {
            $berkas->kk = $pathkk;
        }
        if ($akta != null || $akta != '') {
            Storage::delete($pathakta);
            $berkas->akta = $akta;
        } else {
            $berkas->akta = $pathakta;
        }
        $berkas->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $berkas = ModelPengadilan::find($id);
        $ktp_old = $berkas->ktp;
        if ($ktp_old != null || $ktp_old != '') {
            Storage::delete($ktp_old);
        }
        $kk_old = $berkas->kk;
        if ($kk_old != null || $kk_old != '') {
            Storage::delete($kk_old);
        }
        $akta_old = $berkas->akta;
        if ($akta_old != null || $akta_old != '') {
            Storage::delete($akta_old);
        }
        $berkas->delete();
        return redirect()->back();
    }
}
