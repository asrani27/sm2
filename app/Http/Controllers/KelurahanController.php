<?php

namespace App\Http\Controllers;

use App\Models\Suara;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KelurahanController extends Controller
{
    public function index()
    {
        $totalTPS = Kelurahan::where('kecamatan_id', Auth::user()->kelurahan_id)->get()->sum(function ($item) {
            return $item->suaratps->count();
        });
        $data = Suara::where('kelurahan_id', Auth::user()->kelurahan_id)->orderBy('tps', 'asc')->get();

        return view('kelurahan.home', compact('data', 'totalTPS'));
    }

    public function edit($id)
    {
        $data = Suara::find($id);


        return view('kelurahan.editsuara', compact('data'));
    }

    public function store(Request $req, $id)
    {
        $data = Suara::find($id);
        $data->nomor_1 = $req->nomor_1;
        $data->nomor_2 = $req->nomor_2;
        $data->nomor_3 = $req->nomor_3;
        $data->saksi = $req->saksi;
        $data->telp = $req->telp;
        $data->tidak_sah = $req->tidak_sah;
        $data->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/kelurahan');
    }
}
