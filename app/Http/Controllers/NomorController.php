<?php

namespace App\Http\Controllers;

use App\Models\Nomor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class NomorController extends Controller
{
    public function index()
    {
        $data = Nomor::orderBy('id', 'DESC')->paginate(10);
        return view('admin.nomor.index', compact('data'));
    }

    public function add()
    {
        return view('admin.nomor.create');
    }
    public function store(Request $req)
    {
        $check = Nomor::where('nomor', $req->nomor)->first();
        if ($check == null) {
            $n = new Nomor;
            $n->nomor = $req->nomor;
            $n->jenis = $req->jenis;
            $n->save();
            Session::flash('success', 'Berhasil disimpan');
            return redirect('/superadmin/nomor');
        } else {
            Session::flash('error', 'nomor sudah ada');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Nomor::find($id);
        return view('admin.nomor.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $n = Nomor::find($id);
        $n->nomor = $req->nomor;
        $n->jenis = $req->jenis;
        $n->save();
        Session::flash('success', 'Berhasil diupdate');
        return redirect('/superadmin/nomor');
    }
    public function delete($id)
    {
        Nomor::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function deleteAll()
    {
        Nomor::get()->map->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function upload(Request $req)
    {
        $file = $req->file;
        $type = 'Xlsx';

        $reader = IOFactory::createReader($type);
        $spreadsheet = $reader->load($file);

        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();
        $nomor = [];
        $jenis = [];

        foreach ($data as $i) {
            array_push($nomor, str_replace('-', '', $i[1]));
            array_push($jenis, $i[2]);
        }

        //simpan
        //dd($nomor, $jenis);
        foreach ($nomor as $key => $s) {

            if ($key == 0) {
            } else {
                $check = Nomor::where('nomor', $s)->where('jenis', $jenis[$key])->first();
                if ($check == null) {
                    //save
                    $n = new Nomor;
                    $n->nomor = $s;
                    $n->jenis = $jenis[$key];
                    $n->save();
                } else {
                }
            }
        }

        Session::flash('success', 'berhasil di import');
        return back();
    }
}
