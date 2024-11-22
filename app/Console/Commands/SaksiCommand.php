<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use App\Models\Suara;
use App\Models\Kecamatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SaksiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createsaksi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $tengah = Kecamatan::where('nama', 'Banjarmasin Tengah')->first()->kelurahan->pluck('id');
        $barat = Kecamatan::where('nama', 'Banjarmasin Barat')->first()->kelurahan->pluck('id');
        $timur = Kecamatan::where('nama', 'Banjarmasin Timur')->first()->kelurahan->pluck('id');
        $selatan = Kecamatan::where('nama', 'Banjarmasin Selatan')->first()->kelurahan->pluck('id');
        $utara = Kecamatan::where('nama', 'Banjarmasin Utara')->first()->kelurahan->pluck('id');

        $tps_tengah = Suara::whereIn('kelurahan_id', $tengah)->pluck('id');
        $tps_barat = Suara::whereIn('kelurahan_id', $barat)->pluck('id');
        $tps_timur = Suara::whereIn('kelurahan_id', $timur)->pluck('id');
        $tps_selatan = Suara::whereIn('kelurahan_id', $selatan)->pluck('id');
        $tps_utara = Suara::whereIn('kelurahan_id', $utara)->pluck('id');

        $tengahUser = User::whereIn('suara_id', $tps_tengah)->get();
        $timurUser = User::whereIn('suara_id', $tps_timur)->get();
        $baratUser = User::whereIn('suara_id', $tps_barat)->get();
        $selatanUser = User::whereIn('suara_id', $tps_selatan)->get();
        $utaraUser = User::whereIn('suara_id', $tps_utara)->get();

        foreach ($tengahUser as $itemTengah) {
            $itemTengah->update([
                'password' => Hash::make('tengah'),
                'nama_kec' => 'tengah'
            ]);
        }

        foreach ($timurUser as $itemTimur) {
            $itemTimur->update([
                'password' => Hash::make('timur'),
                'nama_kec' => 'timur'
            ]);
        }

        foreach ($baratUser as $itemBarat) {
            $itemBarat->update([
                'password' => Hash::make('barat'),
                'nama_kec' => 'barat'
            ]);
        }

        foreach ($selatanUser as $itemSelatan) {
            $itemSelatan->update([
                'password' => Hash::make('selatan'),
                'nama_kec' => 'selatan'
            ]);
        }

        foreach ($utaraUser as $itemUtara) {
            $itemUtara->update([
                'password' => Hash::make('utara'),
                'nama_kec' => 'utara'
            ]);
        }

        // $data = Suara::get()->map(function ($item) {
        //     $item->nama_kelurahan = $item->kelurahan == null ? null : str_replace(' ', '_', strtolower($item->kelurahan->nama));
        //     $item->username = $item->nama_kelurahan . '_' . $item->tps;
        //     $param['suara_id'] = $item->id;
        //     $param['username'] = $item->username;
        //     return $param;
        // });

        // $role = Role::where('name', 'saksi')->first();
        // foreach ($data as $item) {
        //     //create user
        //     $check = User::where('username', $item['username'])->first();
        //     if ($check == null) {
        //         $n = new User;
        //         $n->username = $item['username'];
        //         $n->password = Hash::make('bjmhebat');
        //         $n->name = $item['username'];
        //         $n->suara_id = $item['suara_id'];
        //         $n->save();

        //         $n->roles()->attach($role);
        //         $this->info("User created: {$item['username']}");
        //     } else {

        //         $this->info("User already exists: {$item['username']}");
        //     }
        // }
    }
}
