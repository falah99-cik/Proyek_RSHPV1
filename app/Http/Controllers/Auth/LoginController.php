<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    public function authenticated(Request $request, $user)
    {
        if ($user->roles->first()->nama_role == 'Administrator') {
            return redirect('/admin/dashboard');
        } elseif ($user->roles->first()->nama_role == 'Resepsionis') {
            return redirect('/resepsionis/dashboard');
        }

        return redirect('/home');
    }

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }
    protected $redirectTo = '/home';

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::with(['roleUser' => function ($query) {
            $query->with('role');
        }])->where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan'])
                ->withInput();
        }

        //cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah'])
                ->withInput();
        }

        $namaRole = Role::where('idrole', $user->roleUser[0]->idrole ?? null)->first();

        //login user ke session
        Auth::login($user);

        //simpan session user
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $user->roleUser[0]->idrole ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUser[0]->status ?? 'active'
        ]);

        return redirect()->intended('/home')->with('success', 'Login berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
