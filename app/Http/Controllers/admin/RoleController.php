<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('admin.role.index', compact('role'));
    }
}
