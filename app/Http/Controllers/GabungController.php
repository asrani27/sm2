<?php

namespace App\Http\Controllers;

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

class GabungController extends Controller
{
    public function index()
    {
        $kelurahan = Kelurahan::get();
        return view('gabung', compact('kelurahan'));
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

                Session::flash('success', 'berhasil gabung');
                Auth::loginUsingId($u->id);
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
}
