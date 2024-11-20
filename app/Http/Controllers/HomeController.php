<?php

namespace App\Http\Controllers;

use App\Models\SM;
use App\Models\DPT;
use App\Models\Lurah;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function superadmin()
    {

        // Mengambil data Kecamatan dengan jumlah TPS melalui relasi Kelurahan
        $kecamatan = Kecamatan::with(['kelurahan' => function ($query) {
            $query->withCount('suaratps');
        }])->get();

        $totalTPS = 0;

        $nomor1 = 0;
        $nomor2 = 0;
        $nomor3 = 0;
        foreach ($kecamatan as $k) {
            $totalTPS += $k->kelurahan->sum('suaratps_count');
        }
        foreach ($kecamatan as $k) {

            $nomor1 += $k->suaratps->sum('nomor_1');
            $nomor2 += $k->suaratps->sum('nomor_2');
            $nomor3 += $k->suaratps->sum('nomor_3');
        }

        $paslon1 = $kecamatan->map(function ($item) {
            $param['y'] = $item->suaratps->sum('nomor_1');
            $param['label'] = $item->nama;
            return $param;
        })->toArray();

        $paslon2 = $kecamatan->map(function ($item) {
            $param['y'] = $item->suaratps->sum('nomor_2');
            $param['label'] = $item->nama;
            return $param;
        })->toArray();

        $paslon3 = $kecamatan->map(function ($item) {
            $param['y'] = $item->suaratps->sum('nomor_3');
            $param['label'] = $item->nama;
            return $param;
        })->toArray();


        $kec = [];
        $kel = [];
        $dpt = $kecamatan->sum('dpt');
        $sahabat = $kecamatan->sum('sahabat');

        $data = Pendaftar::get()->map(function ($item) {
            $item->dibawai = Pendaftar::where('pendaftar_id', $item->id)->count();
            return $item;
        })->sortByDesc('dibawai');

        return view('admin.home', compact('paslon1', 'paslon2', 'paslon3', 'kec', 'dpt', 'kel', 'sahabat', 'data', 'kecamatan', 'totalTPS', 'nomor1', 'nomor2', 'nomor3'));
    }

    public function user()
    {

        $data = Pendaftar::where('pendaftar_id', Auth::user()->pendaftar->id)->get();

        return view('user.home', compact('data'));
    }

    public function pemohon()
    {
        $permohonan = Tpermohonan::orderBy('id', 'DESC')->paginate(15);
        return view('pemohon.home', compact('permohonan'));
    }

    public function updatelurah(Request $request)
    {
        Lurah::first()->update($request->all());
        Session::flash('success', 'Berhasil Diupdate');
        return back();
    }
}
