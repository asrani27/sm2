<?php

namespace App\Http\Controllers;

use App\Models\RT;
use App\Models\SM;
use App\Models\DPT;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function sm()
    {
        $data = SM::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);
        return view('user.sm.index', compact('data'));
    }
    public function sm_create()
    {
        $kelurahan = Kelurahan::get();
        return view('user.sm.create', compact('kelurahan'));
    }
    public function sm_edit($id)
    {
        $data = SM::find($id);
        $rt = RT::get();
        return view('user.sm.edit', compact('data', 'rt'));
    }
    public function sm_delete($id)
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
    public function sm_store(Request $req)
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
                $n->kelurahan_id = $req->kelurahan_id;
                $n->rt = $req->rt;
                $n->pendaftar_id = Auth::user()->pendaftar->id;
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

                Session::flash('success', 'berhasil didaftarkan, password : sm2024');
                return redirect('/user');
                // all good
            } catch (\Exception $e) {

                DB::rollback();
                Session::flash('error', 'Gagal gabung');
                return back();
                // something went wrong
            }
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
        return redirect('/user/sm');
    }
}
