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
        $kecamatan = Kecamatan::get();

        $kec = [];
        $kel = [];
        $dpt = $kecamatan->sum('dpt');
        $sahabat = $kecamatan->sum('sahabat');

        $data = Pendaftar::get()->map(function ($item) {
            $item->dibawai = Pendaftar::where('pendaftar_id', $item->id)->count();
            return $item;
        })->sortByDesc('dibawai');
        return view('admin.home', compact('kec', 'dpt', 'kel', 'sahabat', 'data', 'kecamatan'));
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
