<?php

namespace App\Http\Controllers;

use App\Models\Suara;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KecamatanController extends Controller
{
    public function index()
    {

        $totalTPS = Kelurahan::where('kecamatan_id', Auth::user()->kecamatan_id)->get()->sum(function ($item) {
            return $item->suaratps->count();
        });

        $nomor1 = 0;
        $nomor2 = 0;
        $nomor3 = 0;

        // foreach ($kecamatan as $k) {
        //     $nomor1 += $k->suaratps->sum('nomor_1');
        //     $nomor2 += $k->suaratps->sum('nomor_2');
        //     $nomor3 += $k->suaratps->sum('nomor_3');
        // }
        $data = Kelurahan::where('kecamatan_id', Auth::user()->kecamatan_id)->get()->map(function ($item) {
            $item->nomor_1 = $item->suaratps->sum('nomor_1');
            $item->nomor_2 = $item->suaratps->sum('nomor_2');
            $item->nomor_3 = $item->suaratps->sum('nomor_3');
            $item->tpsmasuk = tpsmasuk($item->id)->count();
            return $item;
        });

        return view('kecamatan.home', compact('data', 'totalTPS'));
    }

    public function kelurahan($id)
    {
        $totalTPS = Kelurahan::where('kecamatan_id', $id)->get()->sum(function ($item) {
            return $item->suaratps->count();
        });

        $nomor1 = 0;
        $nomor2 = 0;
        $nomor3 = 0;

        // foreach ($kecamatan as $k) {
        //     $nomor1 += $k->suaratps->sum('nomor_1');
        //     $nomor2 += $k->suaratps->sum('nomor_2');
        //     $nomor3 += $k->suaratps->sum('nomor_3');
        // }
        $kelurahan = Kelurahan::find($id);
        $data = Suara::where('kelurahan_id', $id)->get();
        return view('kecamatan.kelurahan', compact('data', 'totalTPS', 'kelurahan'));
    }
    public function edit($id, $id_tps)
    {
        $data = Suara::find($id_tps);

        return view('kecamatan.editsuara', compact('data'));
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
        return redirect('/kecamatan/kelurahan/' . $data->kelurahan_id);
    }
}
