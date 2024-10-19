<?php

namespace App\Http\Controllers;

use App\Models\DPT;
use App\Models\FileDpt;
use App\Jobs\DispatchDpt;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DPTController extends Controller
{
    public function index()
    {
        $data = DPT::orderBy('id', 'DESC')->paginate(10);
        $file = DB::table('jobs')->count();

        $kecamatan = Kecamatan::get();
        return view('admin.dpt.index', compact('data', 'file', 'kecamatan'));
    }

    public function refresh()
    {
        $kecamatan = Kecamatan::get();
        foreach ($kecamatan as $key => $kec) {
            $kec->update([
                'dpt' => DPT::where('kecamatan', strtoupper($kec->nama))->count(),
                'sahabat' => DPT::where('kecamatan', strtoupper($kec->nama))->where('sahabat', 1)->count(),
            ]);
        }

        $kelurahan = Kelurahan::get();
        foreach ($kelurahan as $key => $kel) {
            $kel->update([
                'dpt' => DPT::where('kelurahan', strtoupper($kel->nama))->count(),
                'sahabat' => DPT::where('kelurahan', strtoupper($kel->nama))->where('sahabat', 1)->count(),
            ]);
        }
        Session::flash('success', 'refresh');
        return redirect('/superadmin');
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = DPT::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        $kecamatan = Kecamatan::get();
        return view('admin.dpt.index', compact('data', 'kecamatan'));
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
            $data_dpt = array_slice($data, 8);

            //simpan DPT
            foreach ($data_dpt as $key => $item) {

                $check = DPT::where('nama', $item[1])
                    ->where('jkel', $item[2])
                    ->where('usia', $item[3])
                    ->where('kelurahan', $item[4])
                    ->where('rt', $item[5])
                    ->where('rw', $item[6])
                    ->first();

                if ($check == null) {
                    if ($item[1] == null) {
                    } else {
                        $n = new DPT;
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
        DPT::get()->map->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function upload_file(Request $req)
    {

        foreach ($req->file as $key => $file) {
            if ($file->getClientOriginalExtension() == 'xlsx') {
                //di simpan
                $file_name = $file->getClientOriginalName();
                $check = FileDpt::where('file', $file_name)->first();
                if ($check == null) {
                    //upload dan simpan
                    $file->storeAs('public/dpt', $file_name);
                    $n = new FileDpt;
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
    public function upload_dpt()
    {
        $data = FileDpt::paginate(20);
        return view('admin.dpt.upload', compact('data'));
    }

    public function delete_file($id)
    {
        $file = FileDpt::find($id);


        Storage::disk('public')->delete('dpt/' . $file->file);
        $file->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function tarik_dpt()
    {
        $data = FileDPT::get();
        foreach ($data as $key => $d) {
            DispatchDpt::dispatch($d);
        }
        Session::flash('success', 'Berhasil di syncron, bekerja di belakang layar');
        return back();
    }
}
