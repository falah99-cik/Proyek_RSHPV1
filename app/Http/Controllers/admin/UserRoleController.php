<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

class UserRoleController extends Controller
{
    public function index()
    {
        $roleUser = RoleUser::with(['user', 'role'])->get();

        return view('admin.user_role.index', compact('roleUser'));
    }

    public function create()
    {
        $users = User::all();
        $role   = Role::all();

        return view('admin.user_role.create', compact('users', 'role'));
    }

    public function store(Request $request)
    {
        $this->validateUserRole($request);

        $data = $this->createUserRole($request);

        RoleUser::create($data);

        return redirect()->route('admin.user_role.index')
            ->with('success', 'User role berhasil ditambahkan');
    }

    /** VALIDATION */
    private function validateUserRole($request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1'
        ]);
    }

    /** HELPER */
    private function createUserRole($request)
    {
        return [
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => $request->status,
        ];
    }
}
