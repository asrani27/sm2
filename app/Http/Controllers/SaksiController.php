<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SaksiController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id', 'DESC')
            ->with('roles') // Pastikan relasi 'roles' dimuat
            ->paginate(1); // Tentukan jumlah item per halaman

        // Manipulasi data setelah paginasi
        $data->getCollection()->transform(function ($item) {
            $item->hak_akses = $item->roles->first() == null ? null : $item->roles->first()->name;
            return $item;
        });

        // Filter hanya yang memiliki hak_akses 'petugas' pada koleksi
        $filteredData = $data->getCollection()->filter(function ($item) {
            return $item->hak_akses === 'petugas';
        });

        // Buat paginator baru dengan data yang sudah difilter
        $data = new \Illuminate\Pagination\LengthAwarePaginator(
            $filteredData,
            $filteredData->count(), // Total item yang sudah difilter
            $data->perPage(), // Jumlah item per halaman
            $data->currentPage(), // Halaman yang sedang ditampilkan
            ['path' => url()->current()] // URL untuk pagination
        );

        // Sekarang, $data berisi data yang sudah difilter dan dipaginasi



        // Filter data berdasarkan hak akses
        // $data = $data->filter(function ($item) {
        //     dd($item->where('hak_akses', 'petugas'));
        //     return $item->hak_akses == 'saksi';
        // });
        return view('admin.user_saksi.index', compact('data'));
    }
}
