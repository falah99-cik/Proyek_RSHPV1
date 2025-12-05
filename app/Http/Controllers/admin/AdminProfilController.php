<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminProfilController extends Controller
{
    /**
     * Tampilkan profil admin.
     */
    public function index()
    {
        $user = Auth::user();    // ambil user yang sedang login

        // jika ada tabel admin sendiri, load di sini
        // contoh: $admin = Admin::where('id_user', $user->iduser)->first();
        $admin = null;

        return view('admin.profil.index', compact('user', 'admin'));
    }


    /**
     * Update profil admin (opsional).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update user basic info
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Upload Foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // simpan ke folder public/uploads/admin/
            $file->move(public_path('uploads/admin'), $filename);

            // simpan nama file ke database
            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('admin.profil.index')
                         ->with('success', 'Profil berhasil diperbarui');
    }
}
