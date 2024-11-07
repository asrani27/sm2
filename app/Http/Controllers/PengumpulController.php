<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengumpul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PengumpulController extends Controller
{
    public function set_pengumpul(Request $req)
    {
        Auth::user()->update(['pengumpul_id' => $req->pengumpul_id]);
        Session::flash('success', 'berhasil');
        return back();
        // if (Pengumpul::where('is_aktif', 1)->first() == null) {
        //     $set = Pengumpul::find($req->pengumpul_id);
        //     $set->is_aktif = 1;
        //     $set->save();
        //     Session::flash('success', 'berhasil');
        //     return back();
        // } else {
        //     Pengumpul::where('is_aktif', 1)->first()->update([
        //         'is_aktif' => null,
        //     ]);
        //     $set = Pengumpul::find($req->pengumpul_id);
        //     $set->is_aktif = 1;
        //     $set->save();
        //     Session::flash('success', 'berhasil');
        //     return back();
        // }
    }
    public function index()
    {
        $data = Pengumpul::withCount('pilkada')->orderBy('id', 'DESC')->get();
        dd($data);
        $data = Pengumpul::orderBy('id', 'DESC')->get()->map(function ($item) {

            $item->jumlahinput = $item->pilkada->count();
            return $item;
        });
        dd($data);
        return view('admin.pengumpul.index', compact('data'));
    }
    public function create()
    {
        return view('admin.pengumpul.create');
    }
    public function edit($id)
    {
        $data = Pengumpul::find($id);
        $admin = User::get();
        return view('admin.pengumpul.edit', compact('data', 'admin'));
    }
    public function delete($id)
    {
        Pengumpul::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $check = Pengumpul::where('nama', $req->nama)->where('telp', $req->telp)->first();
        if ($check == null) {
            $n = new Pengumpul();
            $n->nama = $req->nama;
            $n->telp = $req->telp;
            $n->users_id = Auth::user()->id;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/pengumpul');
        } else {
            Session::flash('error', 'data ini sudah pernah di input');
            return back();
        }
    }
    public function update(Request $req, $id)
    {
        $data = Pengumpul::find($id);
        $data->nama = $req->nama;
        $data->telp = $req->telp;
        $data->users_id = $req->users_id;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/pengumpul');
    }
}
