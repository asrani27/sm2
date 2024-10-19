<?php

namespace App\Http\Controllers;

use App\Models\DPT;
use App\Models\Grup;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PendaftarController extends Controller
{
    public function index()
    {
        $data = Pendaftar::paginate(10);
        return view('admin.pendaftar.index', compact('data'));
    }
    public function create()
    {
        $kelurahan = Kelurahan::get();
        $grup = Grup::get();
        $oleh = Pendaftar::get();
        return view('admin.pendaftar.create', compact('grup', 'kelurahan', 'oleh'));
    }
    public function delete($id)
    {
        $check = DPT::where('nik', Pendaftar::where('id', $id)->first()->nik)->first();
        if ($check != null) {
            $check->update(['sahabat' => null, 'grup_id' => null]);
        } else {
        }
        Pendaftar::where('id', $id)->first()->user->delete();
        Pendaftar::where('id', $id)->first()->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $check = Pendaftar::where('nik', $req->nik)->first();
        if ($check != null) {
            Session::flash('warning', 'NIK Sudah terdaftar');
            $req->flash();
            return back();
        } else {
            DB::beginTransaction();

            try {
                //check DPT
                $checkDPT = DPT::where('nik', $req->nik)->first();
                if ($checkDPT == null) {
                } else {
                    $checkDPT->update(['sahabat' => 1]);
                }

                $n = new Pendaftar;
                $n->id = Str::uuid()->toString();
                $n->nik = $req->nik;
                $n->nama = $req->nama;
                $n->telp = $req->telp;
                $n->kelurahan_id = $req->kelurahan_id;
                $n->rt = $req->rt;
                $n->save();

                $role = Role::where('name', 'user')->first();

                $u = new User;
                $u->name = $req->nama;
                $u->username = $req->nik;
                $u->password = bcrypt('sm2024');
                $u->pendaftar_id = $n->id;
                $u->save();

                $u->roles()->attach($role);

                DB::commit();

                Session::flash('success', 'berhasil di simpan');
                return redirect('/superadmin/pendaftar');
                // all good
            } catch (\Exception $e) {

                DB::rollback();
                Session::flash('error', 'Gagal gabung');
                return back();
                // something went wrong
            }
        }
    }

    public function update(Request $req, $id)
    {
        $checkDPT = DPT::where('nik', $req->nik)->first();
        if ($checkDPT == null) {
        } else {
            $checkDPT->update(['sahabat' => 1]);
        }

        $n = Pendaftar::where('id', $id)->first();
        $n->nik = $req->nik;
        $n->nama = $req->nama;
        $n->kelurahan_id = $req->kelurahan_id;
        $n->rt = $req->rt;
        $n->telp = $req->telp;
        $n->grup_id = $req->grup_id;
        $n->save();

        Session::flash('success', 'berhasil di simpan');
        return redirect('/superadmin/pendaftar');
    }

    public function edit($id)
    {
        $data = Pendaftar::find($id);
        $kelurahan = Kelurahan::get();
        $grup = Grup::get();
        return view('admin.pendaftar.edit', compact('grup', 'kelurahan', 'data'));
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = Pendaftar::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        return view('admin.pendaftar.index', compact('data'));
    }
}
