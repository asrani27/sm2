<?php

namespace App\Http\Controllers;

use App\Models\Pilkada;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use App\Models\Pengumpul;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PendukungExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class PetugasController extends Controller
{

    public function bukaKunci($id)
    {
        $data = Pilkada::find($id)->update([
            'kunci' => null,
        ]);

        Session::flash('success', 'Berhasil');
        return redirect()->back();
    }
    public function kunciData($id)
    {
        $data = Pilkada::find($id)->update([
            'kunci' => 1,
        ]);

        Session::flash('success', 'Berhasil');
        return redirect()->back();
    }
    public function filterPilkada()
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
            $query->where('nama', 'like', '%' . $nama . '%')->orWhere('nik', 'like', '%' . $nama . '%');
        }

        // Eksekusi query dan ambil hasil
        $data = $query->paginate($list);


        return view('petugas.pilkada.index', compact('data', 'kecamatan'));
    }
    public function pilkada()
    {
        $data = Pilkada::orderBy('id', 'DESC')->paginate(20);
        $kecamatan = Kecamatan::get();
        return view('petugas.pilkada.index', compact('data', 'kecamatan'));
    }

    public function beranda()
    {
        return view('petugas.home');
    }
    public function laporan()
    {
        Session::forget('success');
        Session::forget('error');
        $kelurahan = Kelurahan::get();
        $koordinator = Pendaftar::get();
        $data = Pilkada::orderBy('id', 'DESC')->paginate(10);
        $kecamatan = Kecamatan::get();
        $gt = null;
        return view('petugas.laporan.index', compact('kelurahan', 'koordinator', 'kecamatan', 'data', 'gt'));
    }
    public function filter()
    {

        if (request()->get('button') == 'csv') {

            $kelurahan = request()->get('kelurahan');
            $tps = request()->get('tps');
            if ($kelurahan == null) {
                Session::flash('info', 'Harap Pilih Kelurahan');
                return back();
            } else {

                $filename = str_replace(' ', '', strtoupper(Kelurahan::where('nama', $kelurahan)->first()->kecamatan->nama)) . '_' . str_replace(' ', '', strtoupper($kelurahan)) . '.csv';
                return Excel::download(new PendukungExport($kelurahan, $tps), $filename, \Maatwebsite\Excel\Excel::CSV);
            }
        } elseif (request()->get('button') == 'filter') {
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
                $query->where('nama', 'like', '%' . $nama . '%');
            }


            // Eksekusi query dan ambil hasil
            $data = $query->paginate($list);


            $gquery = Pilkada::query(); // Ganti dengan model yang sesuai

            // Jika ada input kecamatan, tambahkan filter kecamatan
            if ($kecamatan) {
                $gquery->where('kecamatan', 'like', '%' . $kecamatan . '%');
            }

            // Filter berdasarkan kelurahan jika ada input kelurahan
            if ($kelurahan) {
                $gquery->where('kelurahan', 'like', '%' . $kelurahan . '%');
            }
            // Filter berdasarkan kelurahan jika ada input rt
            if ($rt) {
                $gquery->where('rt', 'like', '%' . $rt . '%');
            }
            // Filter berdasarkan kelurahan jika ada input tps
            if ($tps) {
                $gquery->where('tps', 'like', '%' . $tps . '%');
            }

            // Filter berdasarkan nama jika ada input nama
            if ($nama) {
                $gquery->where('nama', 'like', '%' . $nama . '%');
            }

            $gg = $gquery->groupBy('pengumpul_id');

            $gt = $gquery->selectRaw('pengumpul_id, COUNT(*) as total');
            $tc = $gquery->get()->count();

            // $group = $query->groupBy('pengumpul_id');
            //dd($data);
            return view('petugas.laporan.index', compact('data', 'kecamatan', 'gt', 'tc'));
        } else {
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
                $query->where('nama', 'like', '%' . $nama . '%');
            }


            // Eksekusi query dan ambil hasil
            $data = $query->get();




            return view('petugas.laporan.preview', compact('data'));
        }
    }

    public function perpetugas()
    {
        $petugas = Pengumpul::find(request()->get('pengumpul'));
        $collection = Pilkada::where('pengumpul_id', request()->get('pengumpul'))->get(); // Ganti $petugasId dengan nilai yang sesuai

        $data = $collection->groupBy('kelurahan')->map(function ($items) {
            return $items->groupBy('rt')->map(function ($groupedByRT) {
                return $groupedByRT->map(function ($individual) {
                    return [
                        'nama' => $individual->nama,
                    ];
                });
            })->sortKeys();
        });

        //dd($data);
        return view('petugas.pdf.petugas', compact('data', 'petugas'));
        // $pdf = Pdf::loadView('petugas.pdf.petugas', compact('data', 'petugas'));
        // return $pdf->stream();
        //        dd($petugas);
    }

    public function perkelurahan()
    {
        $kelurahan = strtoupper(request()->get('kelurahan'));

        $data = DB::table('dpt_pilkada')
            ->select(
                'kelurahan',
                'rt',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN pengumpul_id IS NOT NULL THEN 1 ELSE 0 END) as jumlah_terdata'),
                DB::raw('SUM(CASE WHEN pengumpul_id IS NULL THEN 1 ELSE 0 END) as jumlah_belum_terdata'),
                DB::raw('ROUND(SUM(CASE WHEN pengumpul_id IS NOT NULL THEN 1 ELSE 0 END) / COUNT(*) * 100, 2) as persentase_terdata'),
                DB::raw('ROUND(SUM(CASE WHEN pengumpul_id IS NULL THEN 1 ELSE 0 END) / COUNT(*) * 100, 2) as persentase_belum_terdata')
            )
            ->where('kelurahan', $kelurahan)
            ->groupBy('kelurahan', 'rt')
            ->orderBy('rt')
            ->get();

        $pdf = Pdf::loadView('petugas.pdf.kelurahan', compact('data', 'kelurahan'));
        return $pdf->stream();
    }
}
