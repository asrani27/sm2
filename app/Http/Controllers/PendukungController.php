<?php

namespace App\Http\Controllers;

use App\Models\DPT;
use App\Models\Pendukung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PendukungController extends Controller
{
    public function index()
    {
        $info = false;
        Session::forget('error');
        return view('admin.pendukung.index', compact('info'));
    }
    public function store(Request $req)
    {

        if ($req->nik === null) {
            Session::forget('success');
            Session::flash('error', 'gagal menambahkan');
            request()->flash();
            return back();
        } else {

            if (Pendukung::where('nik', $req->nik)->first() == null) {

                Session::forget('error');
                Session::flash('success', 'Data Berhasil Di Tambahkan');
                request()->flash();
                $new = new Pendukung;
                $new->nik = $req->nik;
                $new->nama = $req->nama;
                $new->kecamatan = $req->kecamatan;
                $new->kelurahan = $req->kelurahan;
                $new->rt = $req->rt;
                $new->tps = $req->tps;
                $new->save();

                $check = Pendukung::where('nik', $req->nik)->first();
                if ($check == null) {
                    $status = false;
                } else {
                    $status = true;
                }
                $info = true;
                $data = DPT::where('nik', $req->nik)->first();
                return view('admin.pendukung.index', compact('data', 'info', 'status'));
            } else {
                Session::forget('success');
                Session::flash('error', 'NIK sudah terdaftar');
                request()->flash();
                $check = Pendukung::where('nik', $req->nik)->first();
                if ($check == null) {
                    $status = false;
                } else {
                    $status = true;
                }
                $info = true;
                $data = DPT::where('nik', $req->nik)->first();
                return view('admin.pendukung.index', compact('data', 'info', 'status'));
            }
        }
    }
    public function check()
    {
        $nik = request()->get('nik');

        $info = true;
        $data = DPT::where('nik', $nik)->first();
        if ($data == null) {
            Session::forget('success');
            Session::flash('error', 'NIK tidak terdaftar sebagai DPT');
            request()->flash();
            $status = null;
            return view('admin.pendukung.index', compact('info', 'data', 'status'));
        } else {
            Session::forget('error');
            Session::flash('success', 'Data Ditemukan');
            request()->flash();
            $check = Pendukung::where('nik', $nik)->first();
            if ($check == null) {
                $status = false;
            } else {
                $status = true;
            }
            return view('admin.pendukung.index', compact('data', 'info', 'status'));
        }
    }
}
