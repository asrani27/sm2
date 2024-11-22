<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Kecamatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class PasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passwordcommand';

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
        $timur = Kecamatan::where('nama', 'Banjarmasin Timur')->first()->kelurahan->pluck('id');
        $barat = Kecamatan::where('nama', 'Banjarmasin Barat')->first()->kelurahan->pluck('id');
        $selatan = Kecamatan::where('nama', 'Banjarmasin Selatan')->first()->kelurahan->pluck('id');
        $utara = Kecamatan::where('nama', 'Banjarmasin Utara')->first()->kelurahan->pluck('id');

        $tengahUser = User::whereIn('kelurahan_id', $tengah)->get();
        $timurUser = User::whereIn('kelurahan_id', $timur)->get();
        $baratUser = User::whereIn('kelurahan_id', $barat)->get();
        $selatanUser = User::whereIn('kelurahan_id', $selatan)->get();
        $utaraUser = User::whereIn('kelurahan_id', $utara)->get();

        foreach ($tengahUser as $item) {
            $item->update([
                'password' => Hash::make('tengah03')
            ]);
        }

        foreach ($timurUser as $item) {
            $item->update([
                'password' => Hash::make('timur03')
            ]);
        }
        foreach ($baratUser as $item) {
            $item->update([
                'password' => Hash::make('barat03')
            ]);
        }
        foreach ($selatanUser as $item) {
            $item->update([
                'password' => Hash::make('selatan03')
            ]);
        }
        foreach ($utaraUser as $item) {
            $item->update([
                'password' => Hash::make('utara03')
            ]);
        }
    }
}
