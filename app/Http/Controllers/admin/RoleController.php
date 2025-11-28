<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('admin.role.index', compact('role'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $this->validateRole($request);

        $data = $this->createRole($request);

        Role::create($data);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil ditambahkan');
    }


    /** VALIDATION */
    private function validateRole($request)
    {
        $request->validate([
            'nama_role' => 'required|min:3|unique:role,nama_role'
        ], [
            'nama_role.unique' => 'Role ini sudah ada!',
        ]);
    }

    /** HELPER */
    private function createRole($request)
    {
        return [
            'nama_role' => $this->formatRole($request->nama_role)
        ];
    }

    private function formatRole($value)
    {
        return ucwords(strtolower($value));
    }
}
