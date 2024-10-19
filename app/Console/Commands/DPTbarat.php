<?php

namespace App\Console\Commands;

use App\Models\DPT;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DPTbarat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dptbarat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate DPT Barat';

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
        $path = base_path('public/assets/barat.xlsx');
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        //simpan DPT
        foreach ($data as $key => $item) {
            if ($key != 0) {
                $n = new DPT;
                $n->kecamatan = $item[1];
                $n->kelurahan = $item[2];
                $n->nik = $item[4];
                $n->nama = $item[5];
                $n->tempat_lahir = $item[6];
                $n->tanggal_lahir = $item[7];
                $n->alamat = $item[10];
                $n->rt = $item[11];
                $n->rw = $item[12];
                $n->tps = $item[13];
                $n->save();
            }
        }
    }
}
