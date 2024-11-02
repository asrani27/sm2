<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\RT;
use App\Models\SM;
use Carbon\Carbon;
use App\Models\TPS;
use App\Models\Role;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Pilkada;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use App\Models\Registrasi;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\KoordinatorTPS;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PendukungExport;
use App\Models\Pengumpul;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function user()
    {
        $data = User::orderBy('id', 'DESC')->paginate(15);
        return view('admin.user.index', compact('data'));
    }
    public function user_create()
    {
        return view('admin.user.create');
    }
    public function user_edit($id)
    {
        $data = User::find($id);

        return view('admin.user.edit', compact('data'));
    }
    public function user_delete($id)
    {
        if (Auth::user()->id == $id) {
            Session::flash('error', 'Tidak bisa di hapus, karena sedang digunakan');
            return back();
        } else {
            $data = User::find($id)->delete();
            Session::flash('success', 'Berhasil Dihapus');
            return back();
        }
    }
    public function user_store(Request $req)
    {
        $checkUser = User::where('username', $req->username)->first();
        $role = Role::where('name', $req->role)->first();
        if ($checkUser == null) {
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {

                $n = new User();
                $n->name = $req->name;
                $n->username = $req->username;
                $n->password = bcrypt($req->password1);
                $n->save();

                $n->roles()->attach($role);
                Session::flash('success', 'Berhasil Disimpan, Password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        } else {
            Session::flash('error', 'Username ini sudah pernah di input');
            return back();
        }
    }
    public function user_update(Request $req, $id)
    {
        $role = Role::where('name', $req->role)->first();
        $data = User::find($id);
        if ($req->password1 == null) {
            //update tanpa password

            $data->name = $req->name;
            $data->save();
            $data->roles()->sync($role);
            Session::flash('success', 'Berhasil Diupdate');
            return redirect('/superadmin/user');
        } else {
            // update beserta password
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {

                $data->password = bcrypt($req->password1);
                $data->name = $req->name;
                $data->save();
                $data->roles()->sync($role);
                Session::flash('success', 'Berhasil Diupdate, password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        }
    }

    public function kecamatan()
    {
        $data = Kecamatan::orderBy('id', 'DESC')->paginate(15);
        return view('admin.kecamatan.index', compact('data'));
    }
    public function kecamatan_create()
    {
        return view('admin.kecamatan.create');
    }
    public function kecamatan_edit($id)
    {
        $data = Kecamatan::find($id);
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
        return view('admin.kecamatan.edit', compact('data', 'latlong'));
    }
    public function kecamatan_delete($id)
    {
        $data = Kecamatan::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function kecamatan_store(Request $req)
    {
        $check = Kecamatan::where('nama', $req->nama)->first();
        if ($check == null) {
            $n = new Kecamatan();
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/kecamatan');
        } else {
            Session::flash('error', 'kecamatan ini sudah pernah di input');
            return back();
        }
    }
    public function kecamatan_update(Request $req, $id)
    {
        $data = Kecamatan::find($id);
        $data->nama = $req->nama;
        $data->koor = $req->koor;
        $data->lat = $req->lat;
        $data->long = $req->long;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/kecamatan');
    }

    public function koor_kecamatan()
    {
        $data = Kecamatan::orderBy('id', 'DESC')->paginate(15);
        return view('admin.koor.kec.index', compact('data'));
    }
    public function koor_kecamatan_create()
    {
        return view('admin.koor.kec.create');
    }
    public function koor_kecamatan_edit($id)
    {
        $data = Kecamatan::find($id);
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
        return view('admin.koor.kec.edit', compact('data', 'latlong'));
    }
    public function koor_kecamatan_delete($id)
    {
        Kecamatan::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function koor_kecamatan_store(Request $req)
    {
        $check = Kecamatan::where('nama', $req->nama)->first();
        if ($check == null) {
            $n = new Kecamatan();
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/koordinator/kecamatan');
        } else {
            Session::flash('error', 'kecamatan ini sudah pernah di input');
            return back();
        }
    }
    public function koor_kecamatan_update(Request $req, $id)
    {
        $data = Kecamatan::find($id);
        $data->nama = $req->nama;
        $data->koor = $req->koor;
        $data->nik = $req->nik;
        $data->telp = $req->telp;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/koordinator/kecamatan');
    }

    public function kelurahan()
    {
        $data = Kelurahan::orderBy('id', 'DESC')->paginate(15);
        return view('admin.kelurahan.index', compact('data'));
    }
    public function kelurahan_create()
    {
        $kec = Kecamatan::get();
        return view('admin.kelurahan.create', compact('kec'));
    }
    public function kelurahan_edit($id)
    {
        $data = Kelurahan::find($id);
        $kec = Kecamatan::get();
        return view('admin.kelurahan.edit', compact('data', 'kec'));
    }
    public function kelurahan_delete($id)
    {
        $data = Kelurahan::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function kelurahan_store(Request $req)
    {
        $check = Kelurahan::where('nama', $req->nama)->first();
        if ($check == null) {
            $n = new Kelurahan();
            $n->kecamatan_id = $req->kecamatan_id;
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/kelurahan');
        } else {
            Session::flash('error', 'kelurahan ini sudah pernah di input');
            return back();
        }
    }
    public function kelurahan_update(Request $req, $id)
    {
        $data = Kelurahan::find($id);
        $data->kecamatan_id = $req->kecamatan_id;
        $data->nama = $req->nama;
        $data->koor = $req->koor;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/kelurahan');
    }

    public function koor_kk_delete($id)
    {
        KK::find($id)->delete();
        Session::flash('success', 'Berhasil');
        return back();
    }
    public function koor_kk_detail($id)
    {
        $data = TPS::find($id);
        return view('admin.koor.kk.detail', compact('data'));
    }
    public function koor_kk_detail_store(Request $req, $id)
    {
        $check = KK::where('tps_id', $id)->where('nomor_kk', $req->nomor_kk)->first();
        if ($check == null) {
            $n = new KK;
            $n->nomor_kk = $req->nomor_kk;
            $n->nama_kk = $req->nama_kk;
            $n->tps_id = $id;
            $n->save();
            Session::flash('success', 'Berhasil Diupdate');
            return back();
        } else {
            Session::flash('error', 'Nomor KK Sudah di input');
            $req->flash();
            return back();
        }
    }

    public function koor_tps()
    {
        $data = Kelurahan::orderBy('id', 'DESC')->get();
        return view('admin.koor.tps.index', compact('data'));
    }

    public function koor_tps_delete($id)
    {
        TPS::find($id)->keluarga->map->delete();
        TPS::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function koor_tps_detail($id)
    {
        $data = Kelurahan::find($id);
        return view('admin.koor.tps.detail', compact('data'));
    }
    public function koor_tps_detail_store(Request $req, $id)
    {
        $check = TPS::where('kelurahan_id', $id)->where('nomor', $req->nomor_tps)->first();
        if ($check == null) {
            $n = new TPS;
            $n->nomor = $req->nomor_tps;
            $n->kelurahan_id = $id;
            $n->save();
            Session::flash('success', 'Berhasil Diupdate');
            return back();
        } else {
            Session::flash('error', 'Nomor TPS Sudah ada');
            return back();
        }
    }
    public function koor_tps_edit($id, $kelurahan_id)
    {
        $data = TPS::find($id);
        $kec = Kecamatan::get();
        return view('admin.koor.tps.edit', compact('data', 'kec', 'kelurahan_id'));
    }
    public function koor_tps_update(Request $req, $id, $kelurahan_id)
    {
        $data = TPS::find($id);
        $data->nik = $req->nik;
        $data->nama = $req->nama;
        $data->telp = $req->telp;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/koordinator/tps/detail/' . $kelurahan_id);
    }

    public function koor_kelurahan()
    {
        $data = Kelurahan::orderBy('id', 'DESC')->get();
        $kec = Kecamatan::get();
        return view('admin.koor.kel.index', compact('data', 'kec'));
    }
    public function koor_kelurahan_create()
    {
        $kec = Kecamatan::get();
        return view('admin.koor.kel.create', compact('kec'));
    }
    public function koor_kelurahan_edit($id)
    {
        $data = Kelurahan::find($id);
        $kec = Kecamatan::get();
        return view('admin.koor.kel.edit', compact('data', 'kec'));
    }
    public function koor_kelurahan_delete($id)
    {
        $data = Kelurahan::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function koor_kelurahan_store(Request $req)
    {
        $check = Kelurahan::where('nama', $req->nama)->first();
        if ($check == null) {
            $n = new Kelurahan();
            $n->kecamatan_id = $req->kecamatan_id;
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/koordinator/kelurahan');
        } else {
            Session::flash('error', 'kelurahan ini sudah pernah di input');
            return back();
        }
    }
    public function koor_kelurahan_update(Request $req, $id)
    {
        $data = Kelurahan::find($id);
        $data->nik = $req->nik;
        $data->nama = $req->nama;
        $data->telp = $req->telp;
        $data->koor = $req->koor;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/koordinator/kelurahan');
    }

    public function rt()
    {
        $data = RT::orderBy('id', 'DESC')->paginate(15);
        return view('admin.rt.index', compact('data'));
    }
    public function rt_create()
    {
        $kel = Kelurahan::get();
        return view('admin.rt.create', compact('kel'));
    }
    public function rt_edit($id)
    {
        $data = RT::find($id);
        $kel = Kelurahan::get();
        return view('admin.rt.edit', compact('data', 'kel'));
    }
    public function rt_delete($id)
    {
        $data = RT::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function rt_store(Request $req)
    {
        $check = RT::where('kelurahan_id', $req->kelurahan_id)->where('nomor', (int)$req->nomor)->first();
        if ($check == null) {
            $n = new RT();
            $n->kelurahan_id = $req->kelurahan_id;
            $n->nama = $req->nama;
            $n->nomor = $req->nomor;
            $n->telp = $req->telp;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/rt');
        } else {
            Session::flash('error', 'rt ini sudah pernah di input');
            return back();
        }
    }
    public function rt_update(Request $req, $id)
    {
        $data = RT::find($id);
        $data->kelurahan_id = $req->kelurahan_id;
        $data->nama = $req->nama;
        $data->nomor = $req->nomor;
        $data->telp = $req->telp;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/rt');
    }

    public function sm()
    {
        $data = SM::orderBy('id', 'DESC')->paginate(15);
        return view('admin.sm.index', compact('data'));
    }
    public function sm_create()
    {
        $rt = RT::get();
        return view('admin.sm.create', compact('rt'));
    }
    public function sm_edit($id)
    {
        $data = SM::find($id);
        $rt = RT::get();
        return view('admin.sm.edit', compact('data', 'rt'));
    }
    public function sm_delete($id)
    {
        $data = SM::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function sm_store(Request $req)
    {
        $check = SM::where('telp', $req->telp)->first();
        if ($check == null) {
            $n = new SM();
            $n->kecamatan_id = RT::find($req->rt_id)->kelurahan->kecamatan->id;
            $n->kelurahan_id = RT::find($req->rt_id)->kelurahan->id;
            $n->rt_id = $req->rt_id;
            $n->nik = $req->nik;
            $n->nama = $req->nama;
            $n->telp = $req->telp;
            $n->user_id = Auth::user()->id;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/sm');
        } else {
            Session::flash('error', 'Telp ini sudah pernah di input');
            return back();
        }
    }
    public function sm_update(Request $req, $id)
    {
        $data = SM::find($id);
        $data->kecamatan_id = RT::find($req->rt_id)->kelurahan->kecamatan->id;
        $data->kelurahan_id = RT::find($req->rt_id)->kelurahan->id;
        $data->rt_id = $req->rt_id;
        $data->nik = $req->nik;
        $data->nama = $req->nama;
        $data->telp = $req->telp;
        $data->user_id = Auth::user()->id;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/sm');
    }

    public function koordinatortps()
    {
        $data = KoordinatorTPS::orderBy('id', 'DESC')->paginate(15);
        return view('admin.koordinatortps.index', compact('data'));
    }
    public function koordinatortps_create()
    {
        $kel = Kelurahan::get();
        return view('admin.koordinatortps.create', compact('kel'));
    }
    public function koordinatortps_edit($id)
    {
        $data = KoordinatorTPS::find($id);
        $kel = Kelurahan::get();
        return view('admin.koordinatortps.edit', compact('data', 'kel'));
    }
    public function koordinatortps_delete($id)
    {
        $data = KoordinatorTPS::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function koordinatortps_store(Request $req)
    {
        $check = KoordinatorTPS::where('kelurahan_id', $req->kelurahan_id)->where('tps', $req->tps)->first();
        if ($check == null) {
            KoordinatorTPS::create($req->all());
            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/koordinatortps');
        } else {
            Session::flash('info', 'nomor tps di kelurahan ini sudah di input');
            return back();
        }
    }

    public function koordinatortps_update(Request $req, $id)
    {
        KoordinatorTPS::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/koordinatortps');
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
        return view('admin.laporan.index3', compact('kelurahan', 'koordinator', 'kecamatan', 'data', 'gt'));
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
            return view('admin.laporan.index3', compact('data', 'kecamatan', 'gt', 'tc'));
        }
    }

    public function perpetugas()
    {
        $petugas = Pengumpul::find(request()->get('pengumpul'));
        $collection = Pilkada::where('pengumpul_id', request()->get('pengumpul'))->get(); // Ganti $petugasId dengan nilai yang sesuai

        $data = $collection->groupBy('kelurahan')->map(function ($items) {
            return $items->groupBy('rt')->map(function ($groupedByRT) {
                return $groupedByRT->count();
            })->sortKeys();
        });

        $pdf = Pdf::loadView('admin.pdf.petugas', compact('data', 'petugas'));
        return $pdf->stream();
        //        dd($petugas);
    }
    public function print()
    {
        $kelurahan = Kelurahan::get();
        $kelurahan_id = request()->get('kelurahan_id');
        $rt = request()->get('rt');

        $nama_kelurahan = Kelurahan::find($kelurahan_id)->nama;

        $data = Pendaftar::where('kelurahan_id', $kelurahan_id)->where('rt', $rt)->get();

        return view('admin.laporan.hasil', compact('kelurahan', 'data', 'nama_kelurahan', 'rt', 'koordinator'));
    }
    public function print2()
    {
        $kelurahan = Kelurahan::get();
        $pendaftar_id = request()->get('pendaftar_id');
        $rt = request()->get('rt');

        $koordinator = Pendaftar::find($pendaftar_id);

        $data = Pendaftar::where('pendaftar_id', $pendaftar_id)->get();

        return view('admin.laporan.hasil2', compact('kelurahan', 'data', 'rt', 'koordinator'));
    }

    public function lap_petugas()
    {
        $data = Petugas::get();
        return view('admin.laporan.lap_petugas', compact('data'));
    }
    public function lap_pemeriksaan()
    {
        $data = Pemeriksaan::get();
        return view('admin.laporan.lap_pemeriksaan', compact('data'));
    }
    public function lap_rekapitulasi()
    {
        $bulan = request()->get('bulan');
        $tahun = request()->get('tahun');

        $data = Pemeriksaan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();

        $namabulan = Carbon::createFromFormat('m', $bulan)->translatedFormat('F');

        return view('admin.laporan.lap_rekapitulasi', compact('data', 'namabulan', 'tahun'));
    }
    public function lap_registrasi()
    {
        $data = Registrasi::get();
        return view('admin.laporan.lap_registrasi', compact('data'));
    }
    // public function lap_arsip()
    // {
    //     $data = Arsip::get()->sortBy('tanggal');
    //     return view('admin.laporan.lap_arsip', compact('data'));
    // }


    public function pemeriksaan_cetak($id)
    {
        $data = Pemeriksaan::find($id);
        return view('admin.laporan.lap_rincian', compact('data'));
    }
}
