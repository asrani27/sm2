<?php

use App\Models\Tkrk;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pengumpul;

function newKrk()
{
    return Tkrk::where('status', 0)->count();
}

function pengumpul()
{
    return Pengumpul::get();
}

function kecamatan()
{
    return Kecamatan::get();
}

function kelurahan()
{
    return Kelurahan::orderBy('nama', 'ASC')->get();
}

function pengumpul_aktif()
{
    if (Pengumpul::where('is_aktif', 1)->first() === null) {
        $result = null;
    } else {
        $result = Pengumpul::where('is_aktif', 1)->first()->id;
    }
    return $result;
}
