<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\ModelPengadilan;
use App\Models\ModelUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ParrentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $namaBulanTahun = $now->locale('id')->format('F Y');

        $data = ModelPengadilan::get();
        $berkasCount = $data->count();
        $pendingCount = $data->where('status', '=', 'Diproses')->count();
        $selesaiCount = $data->where('status', '=', 'Selesai')->count();
        $ditolakCount = $data->where('status', '=', 'Ditolak')->count();

        $dataBulanIni = ModelPengadilan::whereMonth('created_at', '=', date('m'))->get();
        $pendingCountBulanIni = $dataBulanIni->where('status', '=', 'Diproses')->count();
        $selesaiCountBulanIni = $dataBulanIni->where('status', '=', 'Selesai')->count();
        $ditolakCountBulanIni = $dataBulanIni->where('status', '=', 'Ditolak')->count();

        return view('parrent.dashboard')->with([
            'user' => $user,
            'Berkas' => ModelPengadilan::paginate(5)->onEachSide('1')->fragment('berkas'),
            'namaBulanTahun' => $namaBulanTahun,
            'berkasCount' => $berkasCount,
            'pendingCount' => $pendingCount,
            'selesaiCount' => $selesaiCount,
            'ditolakCount' => $ditolakCount,
            'pendingCountBulanIni' => $pendingCountBulanIni,
            'selesaiCountBulanIni' => $selesaiCountBulanIni,
            'ditolakCountBulanIni' => $ditolakCountBulanIni
        ]);
    }

    public function profile(Request $r)
    {
        $user = Auth::user();
        return view('parrent.profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Update general info
        $user->name = $request->input('nama');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->alamat = $request->input('alamat');
        $user->save();

        // Update password if requested
        if ($request->input('change_password')) {
            $this->validate($request, [
                'current_password' => 'required',
                'new_password' => 'required|confirmed|min:6',
            ], [
                'current_password.required' => "Masukkan password saat ini",
                'new_password.required' => "Masukkan password baru"
            ]);

            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
                $user->save();
            } else {
                return back()->withErrors(['current_password' => 'Password sekarang tidak valid.']);
            }
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function photo(Request $request)
    {
        $user = Auth::user();

        // Validate file input
        $validatedData = $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if file input exists
        if ($request->hasFile('avatar')) {
            // Get the old avatar path
            $oldAvatar = $user->photo;

            // Store the new avatar and get the path
            $avatar = $request->file('avatar')->store('avatars');

            // Update the user's photo column with the new path
            $user->photo = $avatar;

            // Delete the old avatar file
            if ($oldAvatar) {
                Storage::delete($oldAvatar);
            }
        }

        // Save the updated user data
        $user->save();

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }

    public function berkas(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');

        $data = ModelPengadilan::sortable()
            ->where('status', '=', 'Diproses');

        if (!empty($cari)) {
            $data = $data->where(function ($query) use ($cari) {
                $query->where('berkas.nik', 'like', '%' . $cari . '%')
                    ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
            });
        }

        $data = $data->whereNull('berkas.berkas')
            ->paginate(5)
            ->onEachSide('1')
            ->fragment('berkas');

        return view('parrent.proses', [
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari
        ]);
    }

    public function proses(Request $r)
    {
        $user = Auth::user();
        $petugas = $user->name;
        $id = $r->id;
        $status = $r->status;
        $keterangan = $r->ket;

        $berkas = ModelPengadilan::find($id);
        $berkas->status = $status;
        $berkas->petugas = $petugas;
        $berkas->keterangan = $keterangan;
        $berkas->save();
        return redirect()->back();
    }

    public function selesai(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        $data = ModelPengadilan::sortable()
            ->where('status', '=', 'Selesai')
            ->when(!empty($cari), function ($query) use ($cari) {
                return $query->where(function ($query) use ($cari) {
                    $query->where('berkas.nik', 'like', '%' . $cari . '%')
                        ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
                });
            })
            ->paginate(5)
            ->onEachSide('1')
            ->fragment('berkas');

        return view('parrent.selesai', [
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari,
        ]);
    }

    public function tolak(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        $data = ModelPengadilan::sortable()
            ->where('status', '=', 'Ditolak')
            ->when(!empty($cari), function ($query) use ($cari) {
                return $query->where(function ($query) use ($cari) {
                    $query->where('berkas.nik', 'like', '%' . $cari . '%')
                        ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
                });
            })
            ->paginate(5)
            ->onEachSide('1')
            ->fragment('berkas');

        return view('parrent.tolak', [
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari,
        ]);
    }

    public function users(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        $data = ModelUsers::sortable()
            ->when(!empty($cari), function ($query) use ($cari) {
                return $query->where(function ($query) use ($cari) {
                    $query->where('users.name', 'like', '%' . $cari . '%');
                });
            })
            ->paginate(5)
            ->onEachSide('1')
            ->fragment('users');

        return view('parrent.users', [
            'user' => $user,
            'Users' => $data,
            'cari' => $cari,
        ]);
    }

    public function hapus($id)
    {
        $users = ModelUsers::find($id);
        $ava_old = $users->photo;
        if ($ava_old != null || $ava_old != '') {
            Storage::delete($ava_old);
        }
        $users->delete();
        return redirect()->back();
    }

    public function reset(Request $r)
    {
        $id = $r->id;
        $user = ModelUsers::find($id);
        $user->password = bcrypt('123456');
        $user->save();
        return redirect()->back();
    }

    public function add(Request $r)
    {
        $username = $r->username;
        $name = $r->name;
        $role = $r->role;

        $user = new ModelUsers();
        $user->username = $username;
        $user->name = $name;
        $user->level = $role;
        $user->password = bcrypt('123456');
        $user->photo = "ava/admin_killua.jpg";
        $user->save();

        return redirect()->back();
    }

    public function belum(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        $data = ModelPengadilan::sortable()
            ->where('status', '=', 'Selesai')
            ->whereNull('berkas.berkas')
            ->when(!empty($cari), function ($query) use ($cari) {
                return $query->where(function ($query) use ($cari) {
                    $query->where('berkas.nik', 'like', '%' . $cari . '%')
                        ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
                });
            })
            ->paginate(5)
            ->onEachSide('1')
            ->fragment('berkas');

        return view('parrent.belum', [
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari,
        ]);
    }

    public function sudah(Request $r)
    {
        $user = Auth::user();
        $cari = $r->query('cari');
        $data = ModelPengadilan::sortable()
            ->where('status', '=', 'Selesai')
            ->whereNotNull('berkas.berkas')
            ->when(!empty($cari), function ($query) use ($cari) {
                return $query->where(function ($query) use ($cari) {
                    $query->where('berkas.nik', 'like', '%' . $cari . '%')
                        ->orWhere('berkas.nama', 'like', '%' . $cari . '%');
                });
            })
            ->paginate(5)
            ->onEachSide('1')
            ->fragment('berkas');

        return view('parrent.sudah', [
            'user' => $user,
            'Berkas' => $data,
            'cari' => $cari,
        ]);
    }

    public function terima(Request $r)
    {
        $id = $r->id;
        $berkas = ModelPengadilan::find($id);
        $berkas->berkas = "sudah";
        $berkas->save();
        return redirect()->back();
    }
}
