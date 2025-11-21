<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roleAktif')->get();
        return view('admin.user_role.index', compact('users'));
    }
}
