<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('login');
    }

    // Tampilkan halaman dashboard (untuk fleksibilitas)
    public function pegawai_dashboard()
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        return view('pegawai/dashboard', compact(
            'user',
        ));
    }


    public function admin_dashboard()
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        return view('admin.dashboard', compact(
            'user',
        ));
    }
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil
            $user = Auth::user();

            // Cek level pengguna dan arahkan ke dashboard yang sesuai
            if ($user->role === 'Admin') {
                // Cek status akun setelah role Admin
                if ($user->status === 'Inactive') {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Akun Anda tidak aktif.');
                }
                return redirect()->route('admin.dashboard')->with('success', "Selamat datang, $user->nama!");
            } elseif ($user->role === 'Pegawai') {
                // Cek status akun setelah role Mitra
                if ($user->status === 'Inactive') {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Akun Anda tidak aktif.');
                }
                return redirect()->route('pegawai.dashboard')->with('success', "Selamat datang, $user->nama!");
            } else {
                // Jika level tidak dikenali, logout dan beri pesan kesalahan
                Auth::logout();
                return redirect()->route('login')->with('error', 'Hak akses tidak valid.');
            }
        } else {
            // Jika login gagal
            return redirect()->back()->with('error', 'Email atau password salah!');
        }
    }


    // Logout
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
