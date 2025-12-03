<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    public function index()
    {
        $roleUser = RoleUser::with(['user', 'role'])->paginate(15);

        return view('admin.user_role.index', compact('roleUser'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.user_role.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validateUserRole($request);

        $data = $this->createUserRoleData($request);

        RoleUser::create($data);

        return redirect()->route('admin.user_role.index')
            ->with('success', 'User Role berhasil ditambahkan');
    }

    public function edit($id)
    {
        $userRole = RoleUser::findOrFail($id);

        $users = User::all();
        $roles = Role::all();

        return view('admin.user_role.edit', compact('userRole', 'users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->validateUserRoleUpdate($request);

        $ur = RoleUser::findOrFail($id);

        $ur->update([
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.user_role.index')
            ->with('success', 'User Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        RoleUser::findOrFail($id)->delete();

        return redirect()->route('admin.user_role.index')
            ->with('success', 'User Role berhasil dihapus.');
    }

    private function validateUserRole($request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1',
        ], [
            'iduser.required' => 'User wajib dipilih',
            'idrole.required' => 'Role wajib dipilih',
            'status.required' => 'Status wajib dipilih',
        ]);
    }

    private function validateUserRoleUpdate($request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1',
        ]);
    }

    private function createUserRoleData($request)
    {
        return [
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => $request->status,
        ];
    }
}
