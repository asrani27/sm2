<?php

namespace App\Console\Commands;

use App\Models\DPT;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Console\Command;

class hitungdpt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hitungdpt';

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
        $kecamatan = Kecamatan::get();
        foreach ($kecamatan as $key => $kec) {
            $kec->update([
                'dpt' => DPT::where('kecamatan', strtoupper($kec->nama))->count(),
            ]);
        }

        $kelurahan = Kelurahan::get();
        foreach ($kelurahan as $key => $kel) {
            $kel->update([
                'dpt' => DPT::where('kelurahan', strtoupper($kel->nama))->count(),
            ]);
        }
    }
}
