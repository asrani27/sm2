<?php

namespace App\Http\Controllers;

use App\Models\Pengumpul;
use App\Models\Pilkada;
use Illuminate\Http\Request;

class ValidController extends Controller
{

    public function index()
    {
        $valid_id = Pengumpul::where('valid', 1)->pluck('id');
        $total_valid = Pilkada::whereIn('pengumpul_id', $valid_id)->count();

        $novalid_id = Pengumpul::where('valid', null)->pluck('id');
        $total_novalid = Pilkada::whereIn('pengumpul_id', $novalid_id)->count();

        $data = Pengumpul::withCount('pilkada')->orderBy('id', 'DESC')->get();
        return view('admin.valid.index', compact('data', 'total_valid', 'total_novalid'));
    }

    public function valid(Request $req)
    {

        if ($req->button === 'valid') {
            Pengumpul::whereIn('id', $req->ids)->update(['valid' => 1]);
        } else {
            Pengumpul::whereIn('id', $req->ids)->update(['valid' => null]);
        }

        return back();
    }
    public function novalid($id)
    {
        Pengumpul::find($id)->update(['valid' => null]);
        return back();
    }
}
