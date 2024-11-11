<?php

use App\Models\Tkrk;
use App\Models\Pilkada;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pengumpul;

function totalBjmTimur()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN TIMUR')->count();
}
function totalBjmBarat()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN BARAT')->count();
}
function totalBjmTengah()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN TENGAH')->count();
}
function totalBjmSelatan()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN SELATAN')->count();
}
function totalBjmUtara()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN UTARA')->count();
}
function totalDPT()
{
    return Pilkada::count();
}
function pendukungTimur()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN TIMUR')->where('pendukung', 1)->count();
}
function pendukungBarat()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN BARAT')->where('pendukung', 1)->count();
}
function pendukungTengah()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN TENGAH')->where('pendukung', 1)->count();
}
function pendukungSelatan()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN SELATAN')->where('pendukung', 1)->count();
}
function pendukungUtara()
{
    return Pilkada::where('kecamatan', 'BANJARMASIN UTARA')->where('pendukung', 1)->count();
}
function pendukung()
{
    return Pilkada::where('pendukung', 1)->count();
}
function newKrk()
{
    return Tkrk::where('status', 0)->count();
}

function pengumpul()
{
    return Pengumpul::get();
}

function tidakterdata($kelurahan, $rt)
{
    return Pilkada::where('kelurahan', $kelurahan)->where('rt', $rt)->where('pengumpul_id', null)->get();
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
