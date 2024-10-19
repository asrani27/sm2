<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GrupController extends Controller
{

    public function index()
    {
        $data = Grup::orderBy('id', 'DESC')->paginate(10);
        return view('admin.grup.index', compact('data'));
    }
    public function create()
    {
        return view('admin.grup.create');
    }
    public function edit($id)
    {
        $data = Grup::find($id);
        if ($data->lat == null) {
            $latlong = [
                'lat' => -3.327460,
                'lng' => 114.588515
            ];
        } else {
            $latlong = [
                'lat' => $data->lat,
                'lng' => $data->long
            ];
        }
        return view('admin.grup.edit', compact('data', 'latlong'));
    }
    public function delete($id)
    {
        $data = Grup::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $check = Grup::where('nama', $req->nama)->first();
        if ($check == null) {
            $n = new grup();
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/timses/grup');
        } else {
            Session::flash('error', 'grup ini sudah pernah di input');
            return back();
        }
    }
    public function update(Request $req, $id)
    {
        $data = Grup::find($id);
        $data->nama = $req->nama;
        $data->koor = $req->koor;
        $data->lat = $req->lat;
        $data->long = $req->long;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/timses/grup');
    }
}
