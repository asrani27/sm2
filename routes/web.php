<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\DPTController;
use App\Http\Controllers\GabungController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\NomorController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PendukungController;
use App\Http\Controllers\PengumpulController;
use App\Http\Controllers\PilkadaController;
use App\Http\Controllers\WAController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('daftar', [DaftarController::class, 'index']);
Route::get('gabung', [GabungController::class, 'index']);
Route::post('gabung', [GabungController::class, 'store']);
Route::get('masuk', [LoginController::class, 'masuk']);
Route::post('masuk', [LoginController::class, 'masukUser']);
Route::post('daftar', [DaftarController::class, 'daftar']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('superadmin', [HomeController::class, 'superadmin']);
    Route::get('superadmin/gp', [GantiPasswordController::class, 'index']);
    Route::post('superadmin/gp', [GantiPasswordController::class, 'update']);
    Route::post('superadmin/sk/updatelurah', [HomeController::class, 'updatelurah']);
    Route::get('superadmin/nomor', [NomorController::class, 'index']);
    Route::get('superadmin/nomor/add', [NomorController::class, 'add']);
    Route::post('superadmin/nomor/add', [NomorController::class, 'store']);
    Route::get('superadmin/nomor/edit/{id}', [NomorController::class, 'edit']);
    Route::post('superadmin/nomor/edit/{id}', [NomorController::class, 'update']);
    Route::get('superadmin/nomor/delete/{id}', [NomorController::class, 'delete']);
    Route::get('superadmin/nomor/delete', [NomorController::class, 'deleteAll']);
    Route::post('superadmin/nomor/upload', [NomorController::class, 'upload']);
    Route::get('superadmin/perbaikannomor', [WAController::class, 'perbaikannomor']);
    Route::get('superadmin/wa', [WAController::class, 'index']);
    Route::post('superadmin/wa/send-message', [WAController::class, 'sendMessage']);
    Route::get('superadmin/wa/edit/{id}', [WAController::class, 'edit']);
    Route::get('superadmin/wa/stop/{id}', [WAController::class, 'stop']);
    Route::get('superadmin/wa/status/{id}', [WAController::class, 'status']);
    Route::post('superadmin/wa/edit/{id}', [WAController::class, 'update']);
    Route::get('superadmin/wa/add', [WAController::class, 'create']);
    Route::get('superadmin/wa/kirim/{id}', [WAController::class, 'kirim']);
    Route::post('superadmin/wa/create', [WAController::class, 'store']);
    Route::get('superadmin/wa/delete/{id}', [WAController::class, 'delete']);

    Route::get('superadmin/pilkada', [PilkadaController::class, 'index']);
    Route::get('superadmin/pilkada/filter', [PilkadaController::class, 'filter']);
    Route::get('superadmin/pilkada/pendukung/{id}', [PilkadaController::class, 'pendukung']);
    Route::get('superadmin/pilkada/pendukung/delete/{id}', [PilkadaController::class, 'deletePendukung']);

    Route::get('superadmin/refresh', [DPTController::class, 'refresh']);
    Route::get('superadmin/dpt/filter', [DPTController::class, 'filter']);
    Route::get('superadmin/dpt', [DPTController::class, 'index']);
    Route::get('superadmin/dpt/add', [DPTController::class, 'add']);
    Route::post('superadmin/dpt/add', [DPTController::class, 'store']);
    Route::get('superadmin/dpt/edit/{id}', [DPTController::class, 'edit']);
    Route::post('superadmin/dpt/edit/{id}', [DPTController::class, 'update']);
    Route::get('superadmin/dpt/delete/{id}', [DPTController::class, 'delete']);
    Route::get('superadmin/dpt/delete', [DPTController::class, 'deleteAll']);
    Route::get('superadmin/dpt/upload', [DPTController::class, 'upload_dpt']);
    Route::post('superadmin/dpt/upload', [DPTController::class, 'upload']);
    Route::post('superadmin/dpt/uploadfile', [DPTController::class, 'upload_file']);
    Route::get('superadmin/dpt/deletefile/{id}', [DPTController::class, 'delete_file']);
    Route::get('superadmin/dpt/tarikdpt', [DPTController::class, 'tarik_dpt']);
    Route::get('superadmin/dpt/cari', [DPTController::class, 'cari']);

    Route::get('superadmin/pendaftar', [PendaftarController::class, 'index']);
    Route::get('superadmin/pendaftar/create', [PendaftarController::class, 'create']);
    Route::post('superadmin/pendaftar/create', [PendaftarController::class, 'store']);
    Route::get('superadmin/pendaftar/cari', [PendaftarController::class, 'cari']);
    Route::get('superadmin/pendaftar/delete/{id}', [PendaftarController::class, 'delete']);
    Route::get('superadmin/pendaftar/edit/{id}', [PendaftarController::class, 'edit']);
    Route::post('superadmin/pendaftar/edit/{id}', [PendaftarController::class, 'update']);

    Route::get('superadmin/user', [AdminController::class, 'user']);
    Route::get('superadmin/user/create', [AdminController::class, 'user_create']);
    Route::post('superadmin/user/create', [AdminController::class, 'user_store']);
    Route::get('superadmin/user/edit/{id}', [AdminController::class, 'user_edit']);
    Route::post('superadmin/user/edit/{id}', [AdminController::class, 'user_update']);
    Route::get('superadmin/user/delete/{id}', [AdminController::class, 'user_delete']);

    Route::get('superadmin/kecamatan', [AdminController::class, 'kecamatan']);
    Route::get('superadmin/kecamatan/create', [AdminController::class, 'kecamatan_create']);
    Route::post('superadmin/kecamatan/create', [AdminController::class, 'kecamatan_store']);
    Route::get('superadmin/kecamatan/edit/{id}', [AdminController::class, 'kecamatan_edit']);
    Route::post('superadmin/kecamatan/edit/{id}', [AdminController::class, 'kecamatan_update']);
    Route::get('superadmin/kecamatan/delete/{id}', [AdminController::class, 'kecamatan_delete']);

    Route::get('superadmin/koordinator/tps', [AdminController::class, 'koor_tps']);
    Route::get('superadmin/koordinator/tps/detail/{id}', [AdminController::class, 'koor_tps_detail']);
    Route::post('superadmin/koordinator/tps/detail/{id}', [AdminController::class, 'koor_tps_detail_store']);
    Route::post('superadmin/koordinator/tps/create', [AdminController::class, 'koor_tps_store']);
    Route::get('superadmin/koordinator/tps/edit/{id}/{kelurahan_id}', [AdminController::class, 'koor_tps_edit']);
    Route::post('superadmin/koordinator/tps/edit/{id}/{kelurahan_id}', [AdminController::class, 'koor_tps_update']);
    Route::get('superadmin/koordinator/tps/delete/{id}', [AdminController::class, 'koor_tps_delete']);

    Route::get('superadmin/koordinator/kk/detail/{id}', [AdminController::class, 'koor_kk_detail']);
    Route::post('superadmin/koordinator/kk/detail/{id}', [AdminController::class, 'koor_kk_detail_store']);
    Route::get('superadmin/koordinator/kk/delete/{id}', [AdminController::class, 'koor_kk_delete']);

    Route::get('superadmin/koordinator/kelurahan', [AdminController::class, 'koor_kelurahan']);
    Route::get('superadmin/koordinator/kelurahan/create', [AdminController::class, 'koor_kelurahan_create']);
    Route::post('superadmin/koordinator/kelurahan/create', [AdminController::class, 'koor_kelurahan_store']);
    Route::get('superadmin/koordinator/kelurahan/edit/{id}', [AdminController::class, 'koor_kelurahan_edit']);
    Route::post('superadmin/koordinator/kelurahan/edit/{id}', [AdminController::class, 'koor_kelurahan_update']);
    Route::get('superadmin/koordinator/kelurahan/delete/{id}', [AdminController::class, 'koor_kelurahan_delete']);

    Route::get('superadmin/koordinator/kecamatan', [AdminController::class, 'koor_kecamatan']);
    Route::get('superadmin/koordinator/kecamatan/create', [AdminController::class, 'koor_kecamatan_create']);
    Route::post('superadmin/koordinator/kecamatan/create', [AdminController::class, 'koor_kecamatan_store']);
    Route::get('superadmin/koordinator/kecamatan/edit/{id}', [AdminController::class, 'koor_kecamatan_edit']);
    Route::post('superadmin/koordinator/kecamatan/edit/{id}', [AdminController::class, 'koor_kecamatan_update']);
    Route::get('superadmin/koordinator/kecamatan/delete/{id}', [AdminController::class, 'koor_kecamatan_delete']);

    Route::get('superadmin/kelurahan', [AdminController::class, 'kelurahan']);
    Route::get('superadmin/kelurahan/create', [AdminController::class, 'kelurahan_create']);
    Route::post('superadmin/kelurahan/create', [AdminController::class, 'kelurahan_store']);
    Route::get('superadmin/kelurahan/edit/{id}', [AdminController::class, 'kelurahan_edit']);
    Route::post('superadmin/kelurahan/edit/{id}', [AdminController::class, 'kelurahan_update']);
    Route::get('superadmin/kelurahan/delete/{id}', [AdminController::class, 'kelurahan_delete']);

    Route::get('superadmin/rt', [AdminController::class, 'rt']);
    Route::get('superadmin/rt/create', [AdminController::class, 'rt_create']);
    Route::post('superadmin/rt/create', [AdminController::class, 'rt_store']);
    Route::get('superadmin/rt/edit/{id}', [AdminController::class, 'rt_edit']);
    Route::post('superadmin/rt/edit/{id}', [AdminController::class, 'rt_update']);
    Route::get('superadmin/rt/delete/{id}', [AdminController::class, 'rt_delete']);

    Route::get('superadmin/sm', [AdminController::class, 'sm']);
    Route::get('superadmin/sm/create', [AdminController::class, 'sm_create']);
    Route::post('superadmin/sm/create', [AdminController::class, 'sm_store']);
    Route::get('superadmin/sm/edit/{id}', [AdminController::class, 'sm_edit']);
    Route::post('superadmin/sm/edit/{id}', [AdminController::class, 'sm_update']);
    Route::get('superadmin/sm/delete/{id}', [AdminController::class, 'sm_delete']);

    Route::get('superadmin/surat', [AdminController::class, 'surat']);
    Route::get('superadmin/surat/create', [AdminController::class, 'surat_create']);
    Route::post('superadmin/surat/create', [AdminController::class, 'surat_store']);
    Route::get('superadmin/surat/edit/{id}', [AdminController::class, 'surat_edit']);
    Route::post('superadmin/surat/edit/{id}', [AdminController::class, 'surat_update']);
    Route::get('superadmin/surat/delete/{id}', [AdminController::class, 'surat_delete']);

    Route::get('superadmin/pengumpul', [PengumpulController::class, 'index']);
    Route::post('superadmin/pilkada/pengumpul', [PengumpulController::class, 'set_pengumpul']);
    Route::get('superadmin/pengumpul/create', [PengumpulController::class, 'create']);
    Route::post('superadmin/pengumpul/create', [PengumpulController::class, 'store']);
    Route::get('superadmin/pengumpul/edit/{id}', [PengumpulController::class, 'edit']);
    Route::post('superadmin/pengumpul/edit/{id}', [PengumpulController::class, 'update']);
    Route::get('superadmin/pengumpul/delete/{id}', [PengumpulController::class, 'delete']);

    Route::get('superadmin/pemeriksaan', [AdminController::class, 'pemeriksaan']);
    Route::get('superadmin/pemeriksaan/create', [AdminController::class, 'pemeriksaan_create']);
    Route::get('superadmin/pemeriksaan/periksa/{id}', [AdminController::class, 'pemeriksaan_create2']);
    Route::post('superadmin/pemeriksaan/create2', [AdminController::class, 'pemeriksaan_store']);
    Route::get('superadmin/pemeriksaan/edit/{id}', [AdminController::class, 'pemeriksaan_edit']);
    Route::post('superadmin/pemeriksaan/edit/{id}', [AdminController::class, 'pemeriksaan_update']);
    Route::get('superadmin/pemeriksaan/delete/{id}', [AdminController::class, 'pemeriksaan_delete']);
    Route::get('superadmin/pemeriksaan/cetak/{id}', [AdminController::class, 'pemeriksaan_cetak']);

    Route::get('superadmin/registrasi', [AdminController::class, 'registrasi']);
    Route::get('superadmin/registrasi/create', [AdminController::class, 'registrasi_create']);
    Route::post('superadmin/registrasi/create', [AdminController::class, 'registrasi_store']);
    Route::get('superadmin/registrasi/edit/{id}', [AdminController::class, 'registrasi_edit']);
    Route::post('superadmin/registrasi/edit/{id}', [AdminController::class, 'registrasi_update']);
    Route::get('superadmin/registrasi/delete/{id}', [AdminController::class, 'registrasi_delete']);

    Route::get('superadmin/koordinatortps', [AdminController::class, 'koordinatortps']);
    Route::get('superadmin/koordinatortps/create', [AdminController::class, 'koordinatortps_create']);
    Route::post('superadmin/koordinatortps/create', [AdminController::class, 'koordinatortps_store']);
    Route::get('superadmin/koordinatortps/edit/{id}', [AdminController::class, 'koordinatortps_edit']);
    Route::post('superadmin/koordinatortps/edit/{id}', [AdminController::class, 'koordinatortps_update']);
    Route::get('superadmin/koordinatortps/delete/{id}', [AdminController::class, 'koordinatortps_delete']);

    Route::get('superadmin/ketuart', [AdminController::class, 'rt']);
    Route::get('superadmin/ketuart/create', [AdminController::class, 'rt_create']);
    Route::post('superadmin/ketuart/create', [AdminController::class, 'rt_store']);
    Route::get('superadmin/ketuart/edit/{id}', [AdminController::class, 'rt_edit']);
    Route::post('superadmin/ketuart/edit/{id}', [AdminController::class, 'rt_update']);
    Route::get('superadmin/ketuart/delete/{id}', [AdminController::class, 'rt_delete']);

    Route::get('superadmin/timses/grup', [GrupController::class, 'index']);
    Route::get('superadmin/timses/grup/create', [GrupController::class, 'create']);
    Route::post('superadmin/timses/grup/create', [GrupController::class, 'store']);
    Route::get('superadmin/timses/grup/edit/{id}', [GrupController::class, 'edit']);
    Route::post('superadmin/timses/grup/edit/{id}', [GrupController::class, 'update']);
    Route::get('superadmin/timses/grup/delete/{id}', [GrupController::class, 'delete']);

    Route::get('superadmin/pendukung', [PendukungController::class, 'index']);
    Route::get('superadmin/pendukung/check', [PendukungController::class, 'check']);
    Route::post('superadmin/pendukung/store', [PendukungController::class, 'store']);

    Route::get('superadmin/laporan', [AdminController::class, 'laporan']);
    Route::get('superadmin/laporan/filter', [AdminController::class, 'filter']);
    Route::get('laporan/print', [AdminController::class, 'print']);
    Route::get('laporan/print2', [AdminController::class, 'print2']);
});

Route::group(['middleware' => ['auth', 'role:user']], function () {

    Route::get('user', [HomeController::class, 'user']);
    Route::get('user/sm', [UserController::class, 'sm']);
    Route::get('user/sm/create', [UserController::class, 'sm_create']);
    Route::post('user/sm/create', [UserController::class, 'sm_store']);
    Route::get('user/sm/edit/{id}', [UserController::class, 'sm_edit']);
    Route::post('user/sm/edit/{id}', [UserController::class, 'sm_update']);
    Route::get('user/sm/delete/{id}', [UserController::class, 'sm_delete']);
});
