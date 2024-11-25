<?php

use App\Models\Tkrk;
use App\Models\Suara;
use App\Models\Paslon;
use App\Models\Pilkada;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pengumpul;

function totalSuaraMasuk()
{
    return Suara::sum('nomor_1') + Suara::sum('nomor_2') + Suara::sum('nomor_3');
}
function totalSuara($nomor)
{
    if ($nomor == 1) {
        return Suara::sum('nomor_1');
    }
    if ($nomor == 2) {
        return Suara::sum('nomor_2');
    }
    if ($nomor == 3) {
        return Suara::sum('nomor_3');
    }
}

function paslon()
{
    return Paslon::orderBy('id', 'DESC')->get();
}

function suaraKelurahan($kelurahan)
{
    return Suara::where('kelurahan_id', $kelurahan)->get();
}

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

function pengumpulvalid()
{
    return Pengumpul::where('valid', 1)->get();
}

function datavalid()
{
    $valid_id = Pengumpul::where('valid', 1)->pluck('id');

    $data = Pilkada::whereIn('pengumpul_id', $valid_id)->get();
    return $data;
}
function totaltpsmasuk()
{
    $data = Suara::get()->map(function ($item) {
        if ($item->nomor_1 === 0 && $item->nomor_2 === 0 && $item->nomor_3 === 0) {
            $result = 0;
        } else {
            $result = 1;
        }
        $item->masuk = $result;
        return $item;
    });


    return $data->where('masuk', 1)->count();
}
function tpsmasukkecamatan($id)
{
    $data = Suara::where('kecamatan_id', $id)->get()->map(function ($item) {
        if ($item->nomor_1 === 0 && $item->nomor_2 === 0 && $item->nomor_3 === 0) {
            $result = 0;
        } else {
            $result = 1;
        }
        $item->masuk = $result;
        return $item;
    });


    return $data->where('masuk', 1);
}

function tpsmasuk($id)
{

    $data = Suara::where('kelurahan_id', $id)->get()->map(function ($item) {
        if ($item->nomor_1 === 0 && $item->nomor_2 === 0 && $item->nomor_3 === 0) {
            $result = 0;
        } else {
            $result = 1;
        }
        $item->masuk = $result;
        return $item;
    });


    return $data->where('masuk', 1);
}

function pengumpul()
{
    return Pengumpul::get();
}

function tidakterdatatps($kelurahan, $tps)
{
    return Pilkada::where('kelurahan', $kelurahan)->where('tps', $tps)->where('pengumpul_id', null)->get();
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
