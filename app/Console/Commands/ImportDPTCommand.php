<?php

namespace App\Console\Commands;

use App\Models\Pilkada;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportDPTCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importdpt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import dpt pilkada';

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
        $files = File::allFiles(public_path('dptpilkada'));

        foreach ($files as $file) {

            $path = base_path('public/dptpilkada/' . $file->getRelativePathname());
            $spreadsheet = IOFactory::load($path);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            $kecamatan = str_replace(': ', '', $data[8][0]);
            $kelurahan = str_replace(': ', '', $data[9][0]);
            $tps = str_replace(': ', '', $data[10][0]);
            foreach (array_slice($data, 13) as $key => $item) {
                if (strlen($item[0]) === 4) {
                    $nama = $item[1];
                    $jkel = $item[3];
                    $usia = substr($item[4], 2);
                    $alamat = $item[5];
                    $rt = substr($item[7], 3);
                    $rw = substr($item[8], 3);

                    $check = Pilkada::where('nama', $nama)->where('jkel', $jkel)->where('usia', $usia)->where('alamat', $alamat)->where('rt', $rt)->where('rw', $rw)->first();
                    if ($check == null) {
                        $n = new Pilkada();
                        $n->kecamatan = $kecamatan;
                        $n->kelurahan = $kelurahan;
                        $n->tps = $tps;
                        $n->nama = $nama;
                        $n->jkel = $jkel;
                        $n->usia = $usia;
                        $n->alamat = $alamat;
                        $n->rt = $rt;
                        $n->rw = $rw;
                        $n->save();
                    } else {
                    }
                } else {
                }
            }
        }
    }
}
