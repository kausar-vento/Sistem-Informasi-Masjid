<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginHakAksesController extends Controller
{
    public function loginUser() {
        return view('login_user');
    }

    public function prosesLogin(Request $req) {
        $validasi = $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($validasi)) {
            if (Auth::user()->verifikasi_pj === 'Non PJ' || Auth::user()->verifikasi_pj === 'Iya') {
                $req->session()->regenerate();
                return redirect()->intended('/user/home');
            } else {
                Auth::logout();
                return redirect()->back()->with('failed', 'Mohon menunggu verifikasi dari admin. karena anda membuat akun sebagai warga PJ');
            }
        }
        return redirect()->back()->with('failed', 'Username atau password salah');
    }

    public function registerUser() {
        return view('register_user');
    }

    public function prosesRegister(Request $req) {
        $validasi = $req->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|min:8',
            'email' => 'required|email:dns',
            'nomor_telp' => 'required',
            'password' => 'required|min:8',
            'jenis_kelamin' => 'required',
            'status_warga' => 'required',
        ]);
        if ($validasi['status_warga'] === 'PJ') {
            $validasi['bukti_status_warga'] = $req->validate(['bukti_status_warga' => 'required|mimes:jpg,png,jpeg|max:3080']);
        }

        if ($req->file('bukti_status_warga')) {
            $validasi['bukti_status_warga'] = $req->file('bukti_status_warga')->store('bukti-ktp-warga');
        }
        // dd($validasi);
        $validasi['password'] = bcrypt($validasi['password']);

        if ($validasi['status_warga'] === 'PJ') {
            $validasi['verifikasi_pj'] = 'Menunggu';
        }
        User::create($validasi);
        return redirect()->route('loginUser')->with('success', 'Akun Berhasil Dibuat, Silahkan Melakukan Login Terlebih dahulu');
    }

    public function prosesLogout() {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('loginUser');
        }
    }

    public function loginAdmin() {
        return view('login_admin');
    }

    public function prosesLoginAdmin(Request $req) {
        $validasi = $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web_admin')->attempt($validasi)) {
            $req->session()->regenerate();
            return redirect()->intended('/admin/laporan-keuangan');
        }

        return redirect()->back()->with('failed', 'Username atau password salah');
    }

    public function prosesLogoutAdmin() {
        if (Auth::guard('web_admin')->check()) {
            Auth::guard('web_admin')->logout();
            return redirect()->route('loginAdmin');
        }
    }

    public function loginPetugas() {
        return view('login_petugas');
    }

    public function prosesLoginPetugas(Request $req) {
        $validasi = $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web_petugas')->attempt($validasi)) {
            $req->session()->regenerate();
            return redirect()->intended('/petugas/event/mengeola/home');
        }

        return redirect()->back()->with('failed', 'Username atau password salah');
    }

    public function prosesLogoutPetugas() {
        if (Auth::guard('web_petugas')->check()) {
            Auth::guard('web_petugas')->logout();
            return redirect()->route('loginPetugas');
        }
    }

    public function loginPetugasAdmin() {
        return view('login-petugas-admin');
    }
}
