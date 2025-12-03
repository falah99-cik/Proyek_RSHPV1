<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* ================================
     * INDEX
     * ================================ */
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $this->validateUser($request);

        $data = $this->prepareUserData($request);

        User::create($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validateUserUpdate($request, $id);

        $data = $this->prepareUserUpdateData($request);

        $user->update($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus');
    }


    private function validateUser($request)
    {
        $request->validate([
            'nama'     => 'required|min:3',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|min:6'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);
    }

    private function validateUserUpdate($request, $id)
    {
        $request->validate([
            'nama'     => 'required|min:3',
            'email'    => 'required|email|unique:user,email,' . $id . ',iduser',
            'password' => 'nullable|min:6'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh user lain.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);
    }


    private function prepareUserData($request)
    {
        return [
            'nama' => $this->formatName($request->nama),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ];
    }

    private function prepareUserUpdateData($request)
    {
        $data = [
            'nama'  => $this->formatName($request->nama),
            'email' => strtolower($request->email),
        ];

        // Jika password diisi, update
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        return $data;
    }

    private function formatName($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
