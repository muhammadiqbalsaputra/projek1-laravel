<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    //fungsi untuk mennampilkan halaman login
    public function login()
    {
        return view('web.customer.login', [
            'title' => 'Login'
        ]);
    }


    // fungsi untuk menampilkan halaman register
    public function register()
    {
        return view('web.customer.register', [
            'title' => 'Register'
        ]);
    }
    // fungsi untuk aksi login ketika button login di klik
    public function store_login(Request $request)
    {
        // validasi
        $credentials = $request->only('email', 'password');
        $validasi = \Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // jika validasi gagal
        if ($validasi->fails()) {
            // jika gagal, kita kembalikan ke halaman login
            // dengan membawa pesan error
            // dan juga inputan yang sudah diisi sebelumnya

            return redirect()->back()
                ->with('errorMessage', 'Validasi error, silahkan cek kembali data anda')
                ->withErrors($validasi)
                ->withInput();
        }

        // cek dulu di dalam database, apakah ada customer dengan email dan password yang sesuai
        $customer = Customer::where('email', $credentials['email'])->first();

        // jika ada, kita cek passwordnya
        // jika passwordnya sesuai, kita login
        // jika tidak ada, kita kembalikan ke halaman login
        // dengan membawa pesan error
        if ($customer && \Hash::check($credentials['password'], $customer->password)) {
            // Login
            \Auth::guard('customer')->login($customer);

            // jika berhasil login, kita redirect ke halaman home
            return redirect()->route('home')
                ->with('successMessage', 'Login berhasil');
        } else {
            return redirect()->back()
                ->with('errorMessage', 'Email atau password salah')
                ->withInput();
        }
    }

    // fungsi untuk aksi register ketika button register di klik
    public function store_register(Request $request)
    {
        // validasi
        $validasi = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:customers,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        // kita cek, apakah validasinhya berhasil atau tidak
        // jika validasi gagal


        if ($validasi->fails()) {
            // jika gagal, kita kembalikan ke halaman register
            // dengan membawa pesan error
            // dan juga inputan yang sudah diisi sebelumnya
            return redirect()->back()
                ->with('errorMessage', 'Validasi error, silahkan cek kembali data anda')
                ->withErrors($validasi)
                ->withInput();
        } else {
            // jika validasi berhasil, kita simpan data customer ke database
            // dan redirect ke halaman login

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = \Hash::make($request->password);
            $customer->save();

            //jika berhasil tersimpan, maka redirect ke halaman login
            return redirect()->route('customer.login')
                ->with('successMessage', 'Registrasi Berhasil');
        }

    }

    // fungsi untuk logout 

    public function logout(Request $request)
    {
        \Auth::guard('customer')->logout();
        return redirect()->route('customer.login')
            ->with('successMessage', 'Anda telah berhasil logout');
    }

}
