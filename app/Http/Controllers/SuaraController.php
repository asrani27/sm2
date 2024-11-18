<?php

namespace App\Http\Controllers;

use App\Models\Suara;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuaraController extends Controller
{
    public function detail_kelurahan($kecamatan)
    {
        $totalTPS = Kelurahan::where('kecamatan_id', $kecamatan)->get()->sum(function ($item) {
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
        $data = Kelurahan::where('kecamatan_id', $kecamatan)->get();
        return view('admin.kelurahan', compact('kecamatan', 'data', 'totalTPS'));
    }

    public function detail_tps($kecamatan, $kelurahan)
    {
        $data = Suara::where('kecamatan_id', $kecamatan)->where('kelurahan_id', $kelurahan)->get();
        $kecamatan = Kecamatan::find($kecamatan);
        $kelurahan = Kelurahan::find($kelurahan);
        return view('admin.tps', compact('kecamatan', 'kelurahan', 'data'));
    }
    public function hapus_tps($kecamatan, $kelurahan, $tps)
    {
        Suara::find($tps)->delete();
        Session::flash('success', 'berhasil');
        return back();
    }
    public function store_tps(Request $req, $kecamatan, $kelurahan)
    {
        $check = Suara::where('kecamatan_id', $kecamatan)->where('kelurahan_id', $kelurahan)->where('tps', $req->nomor_tps)->first();
        if ($check == null) {
            $n = new Suara();
            $n->kecamatan_id = $kecamatan;
            $n->kelurahan_id = $kelurahan;
            $n->tps = $req->nomor_tps;
            $n->nomor_1 = 0;
            $n->nomor_2 = 0;
            $n->nomor_3 = 0;
            $n->save();
            Session::flash('success', 'berhasil');
            return back();
        } else {
            Session::flash('error', 'Nomor TPS sudah ada');
            return back();
        }
    }
    public function isi_suara($kecamatan, $kelurahan, $tps)
    {
        $data = Suara::find($tps);
        $kecamatan = Kecamatan::find($kecamatan);
        $kelurahan = Kelurahan::find($kelurahan);
        return view('admin.isi_tps', compact('kecamatan', 'kelurahan', 'data'));
    }

    public function store_suara(Request $req, $kecamatan, $kelurahan, $tps)
    {
        $data = Suara::find($tps);
        $data->saksi = $req->saksi;
        $data->telp = $req->telp;
        $data->nomor_1 = $req->nomor_1;
        $data->nomor_2 = $req->nomor_2;
        $data->nomor_3 = $req->nomor_3;
        $data->sah = $req->sah;
        $data->tidak_sah = $req->tidak_sah;
        $data->save();
        Session::flash('success', 'berhasil');
        return redirect('/superadmin/suara/' . $kecamatan . '/' . $kelurahan);
    }
}
