<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SaksiTpsController extends Controller
{
    public function index()
    {
        $data = Auth::user()->suaratps;

        return view('saksi.home', compact('data'));
    }

    public function store(Request $req)
    {
        if ($req->hasFile('file')) {
            // Validasi file yang di-upload
            $req->validate([
                'file' => 'mimes:jpeg,jpg,png|max:6096', // Maksimal 2MB
            ]);
            // Simpan file di folder "public/images"
            $path = $req->file('file')->store('public/suara');

            $filename = basename($path);
        } else {
            $filename = Auth::user()->suaratps->filename;
        }

        $data = Auth::user()->suaratps;
        $data->nomor_1 = $req->nomor_1;
        $data->nomor_2 = $req->nomor_2;
        $data->nomor_3 = $req->nomor_3;
        $data->saksi = $req->saksi;
        $data->telp = $req->telp;
        $data->sah = $req->sah;
        $data->tidak_sah = $req->tidak_sah;
        $data->filename = $filename;
        $data->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return back();
    }
}
