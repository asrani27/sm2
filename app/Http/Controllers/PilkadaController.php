<?php

namespace App\Http\Controllers;

use App\Models\Pilkada;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PilkadaController extends Controller
{
    public function index()
    {
        $data = Pilkada::orderBy('id', 'DESC')->paginate(20);
        $kecamatan = Kecamatan::get();
        return view('admin.pilkada.index', compact('data', 'kecamatan'));
    }

    public function deletePendukung($id)
    {
        Pilkada::find($id)->update([
            'pendukung' => 0,
            'pengumpul_id' => null,
        ]);
        return back();
    }
    public function pendukung($id)
    {

        if (Auth::user()->pengumpul_id == null) {
            Session::flash('error', 'harap pilih petugas/pengumpul data');
            return back();
        } else {
            Pilkada::find($id)->update([
                'pendukung' => 1,
                'pengumpul_id' => Auth::user()->pengumpul_id,
            ]);
            return back();
        }
    }

    public function filter()
    {
        $kecamatan = request()->get('kecamatan');
        $kelurahan = request()->get('kelurahan');
        $list = (int)request()->get('list');
        $rt = request()->get('rt');
        $tps = request()->get('tps');
        $nama = request()->get('nama');

        $query = Pilkada::query(); // Ganti dengan model yang sesuai

        // Jika ada input kecamatan, tambahkan filter kecamatan
        if ($kecamatan) {
            $query->where('kecamatan', 'like', '%' . $kecamatan . '%');
        }

        // Filter berdasarkan kelurahan jika ada input kelurahan
        if ($kelurahan) {
            $query->where('kelurahan', 'like', '%' . $kelurahan . '%');
        }
        // Filter berdasarkan kelurahan jika ada input rt
        if ($rt) {
            $query->where('rt', 'like', '%' . $rt . '%');
        }
        // Filter berdasarkan kelurahan jika ada input tps
        if ($tps) {
            $query->where('tps', 'like', '%' . $tps . '%');
        }

        // Filter berdasarkan nama jika ada input nama
        if ($nama) {
            $query->where('nama', 'like', '%' . $nama . '%')->where('nik', 'like', '%' . $nama . '%');
        }

        // Eksekusi query dan ambil hasil
        $data = $query->paginate($list);


        return view('admin.pilkada.index', compact('data', 'kecamatan'));
    }
    public function refresh()
    {
        $kecamatan = Kecamatan::get();
        foreach ($kecamatan as $key => $kec) {
            $kec->update([
                'pilkada' => pilkada::where('kecamatan', strtoupper($kec->nama))->count(),
                'sahabat' => pilkada::where('kecamatan', strtoupper($kec->nama))->where('sahabat', 1)->count(),
            ]);
        }

        $kelurahan = Kelurahan::get();
        foreach ($kelurahan as $key => $kel) {
            $kel->update([
                'pilkada' => pilkada::where('kelurahan', strtoupper($kel->nama))->count(),
                'sahabat' => pilkada::where('kelurahan', strtoupper($kel->nama))->where('sahabat', 1)->count(),
            ]);
        }
        Session::flash('success', 'refresh');
        return redirect('/superadmin');
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = pilkada::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        $kecamatan = Kecamatan::get();
        return view('admin.pilkada.index', compact('data', 'kecamatan'));
    }
    public function upload(Request $req)
    {
        //dd($req->all());
        $file = $req->file;
        $type = 'Xlsx';

        foreach ($file as $key => $f) {

            $reader = IOFactory::createReader($type);
            $spreadsheet = $reader->load($f);

            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            $kecamatan = str_replace(': ', '', $data[3][7]);
            $kelurahan = str_replace(': ', '', $data[4][7]);
            $tps = str_replace(': ', '', $data[5][7]);
            $data_pilkada = array_slice($data, 8);

            //simpan pilkada
            foreach ($data_pilkada as $key => $item) {

                $check = pilkada::where('nama', $item[1])
                    ->where('jkel', $item[2])
                    ->where('usia', $item[3])
                    ->where('kelurahan', $item[4])
                    ->where('rt', $item[5])
                    ->where('rw', $item[6])
                    ->first();

                if ($check == null) {
                    if ($item[1] == null) {
                    } else {
                        $n = new pilkada;
                        $n->nama = $item[1];
                        $n->jkel = $item[2];
                        $n->usia = $item[3];
                        $n->kelurahan = $item[4];
                        $n->rt = $item[5];
                        $n->rw = $item[6];
                        $n->tps = $tps;
                        $n->kecamatan = $kecamatan;
                        $n->save();
                    }
                } else {
                }
            }
        }

        Session::flash('success', 'berhasil di import');
        return back();
    }
    public function deleteAll()
    {
        pilkada::get()->map->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function upload_file(Request $req)
    {

        foreach ($req->file as $key => $file) {
            if ($file->getClientOriginalExtension() == 'xlsx') {
                //di simpan
                $file_name = $file->getClientOriginalName();
                $check = Filepilkada::where('file', $file_name)->first();
                if ($check == null) {
                    //upload dan simpan
                    $file->storeAs('public/pilkada', $file_name);
                    $n = new Filepilkada;
                    $n->file = $file_name;
                    $n->save();
                } else {
                }
            } else {
                //tidak di simpan

            }
        }
        Session::flash('success', 'Berhasil diupload');
        return back();
    }
    public function upload_pilkada()
    {
        $data = Filepilkada::paginate(20);
        return view('admin.pilkada.upload', compact('data'));
    }

    public function delete_file($id)
    {
        $file = Filepilkada::find($id);


        Storage::disk('public')->delete('pilkada/' . $file->file);
        $file->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function tarik_pilkada()
    {
        $data = Filepilkada::get();
        foreach ($data as $key => $d) {
            Dispatchpilkada::dispatch($d);
        }
        Session::flash('success', 'Berhasil di syncron, bekerja di belakang layar');
        return back();
    }
}
