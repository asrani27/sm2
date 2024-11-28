<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Suara;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetSuara extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resetsuara';

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
        $tps = User::where('suara_id', '!=', NULL)->update([
            'password' => Hash::make('admin310891')
        ]);

        $kel = User::where('kelurahan_id', '!=', NULL)->update([
            'password' => Hash::make('admin310891')
        ]);

        $kec = User::where('kecamatan_id', '!=', NULL)->update([
            'password' => Hash::make('admin310891')
        ]);
        // Suara::get()->map(function ($item) {
        //     $item->saksi_lama = $item->saksi;
        //     $item->telp_lama = $item->telp;
        //     $item->save();
        //     return $item;
        // });

        // $this->info('Data berhasil diperbarui.');
        // $data = Suara::query()->update([
        //     'saksi' => null,
        //     'telp' => null,
        //     'nomor_1' => 0,
        //     'nomor_2' => 0,
        //     'nomor_3' => 0,
        //     'sah' => 0,
        //     'tidak_sah' => 0,
        // ]);
        // if ($data > 0) {
        //     $this->info('Data berhasil diperbarui.');
        // } else {
        //     $this->warn('Tidak ada data yang diperbarui.');
        // }
    }
}
