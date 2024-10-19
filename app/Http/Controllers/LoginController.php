<?php

namespace App\Http\Controllers;

use captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('superadmin');
            } elseif (Auth::user()->hasRole('user')) {
                return redirect('user');
            }
        }

        return view('login');
    }

    public function masuk()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('superadmin');
            } elseif (Auth::user()->hasRole('user')) {
                return redirect('user');
            }
        }

        return view('masuk');
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function login(Request $req)
    {
        $remember = $req->remember ? true : false;
        $credential = $req->only('username', 'password');

        if (Auth::attempt($credential, true)) {

            if (Auth::user()->hasRole('superadmin')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('superadmin');
            }
            if (Auth::user()->hasRole('user')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('user');
            }
        } else {
            Session::flash('error', 'username/password salah');
            $req->flash();
            return back();
        }
    }

    public function masukUser(Request $req)
    {
        $remember = $req->remember ? true : false;
        $credential = $req->only('username', 'password');

        if (Auth::attempt($credential, $remember)) {

            if (Auth::user()->hasRole('superadmin')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('superadmin');
            }
            if (Auth::user()->hasRole('user')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('user');
            }
        } else {
            Session::flash('error', 'username/password salah');
            $req->flash();
            return back();
        }
    }
}
