<?php

namespace App\Console\Commands;

use App\Models\Pilkada;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $selatan = File::allFiles(public_path('dptselatan'));
        $timur = File::allFiles(public_path('dpttimur'));
        $barat = File::allFiles(public_path('dptbarat'));
        $tengah = File::allFiles(public_path('dpttengah'));
        $utara = File::allFiles(public_path('dptutara'));
        foreach ($timur as $file) {

            $path = base_path('public/dpttimur/' . $file->getRelativePathname());
            $spreadsheet = IOFactory::load($path);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            $kecamatan = str_replace(': ', '', $data[8][0]);
            $kelurahan = str_replace(': ', '', $data[9][0]);
            $tps = str_replace(': ', '', $data[10][0]);

            foreach (array_slice($data, 13) as $key => $item) {

                if (strlen($item[0]) === 4) {
                    $param = [
                        'kecamatan' => $kecamatan,
                        'kelurahan' => $kelurahan,
                        'tps' => $tps,
                        'nama' => $item[1],
                        'jkel' => $item[3],
                        'usia' => substr($item[4], 2),
                        'alamat' => $item[5],
                        'rt' => substr($item[7], 3),
                        'rw' => substr($item[8], 3),
                    ];

                    Pilkada::create($param);
                } else {
                }
            }
        }

        dd('sukses');
    }
}
