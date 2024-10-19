<?php

namespace App\Jobs;

use App\Models\DPT;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class TarikDPT implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $dpt;
    public function __construct($dpt)
    {
        $this->dpt = $dpt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = 'storage/dpt/' . $this->dpt->file;

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        $kecamatan = str_replace(': ', '', $data[3][7]);
        $kelurahan = str_replace(': ', '', $data[4][7]);
        $tps = str_replace(': ', '', $data[5][7]);
        $data_dpt = array_slice($data, 8);

        //simpan DPT
        foreach ($data_dpt as $key => $item) {
            $check = DPT::where('nama', $item[1])
                ->where('jkel', $item[2])
                ->where('usia', $item[3])
                ->where('kelurahan', $item[4])
                ->where('rt', $item[5])
                ->where('rw', $item[6])
                ->first();

            if ($check == null) {
                if ($item[1] == null) {
                } else {
                    $n = new DPT;
                    $n->nama = $item[1];
                    $n->jkel = $item[2];
                    $n->usia = $item[3];
                    $n->kelurahan = $item[4];
                    $n->rt = $item[5];
                    $n->rw = $item[6];
                    $n->tps = $tps;
                    $n->kecamatan = $kecamatan;
                    $n->save();
                }
            } else {
            }
        }
    }
}
