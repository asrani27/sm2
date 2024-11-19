<?php

namespace App\Http\Controllers;

use App\Models\Pengumpul;
use Illuminate\Http\Request;

class ValidController extends Controller
{

    public function index()
    {
        $data = Pengumpul::withCount('pilkada')->orderBy('id', 'DESC')->get();
        return view('admin.valid.index', compact('data'));
    }

    public function valid($id)
    {
        Pengumpul::find($id)->update(['valid' => 1]);
        return back();
    }
    public function novalid($id)
    {
        Pengumpul::find($id)->update(['valid' => null]);
        return back();
    }
}
