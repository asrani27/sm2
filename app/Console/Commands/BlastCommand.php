<?php

namespace App\Console\Commands;

use App\Models\IP;
use GuzzleHttp\Client;
use App\Models\Riwayat;
use Illuminate\Console\Command;

class BlastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wablast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'WA Blast';

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
        $riwayat = Riwayat::where('status', null)->first();
        $nomor = $riwayat->telp;
        $filename = $riwayat->whatsapp->file;
        $isi = $riwayat->whatsapp->isi;
        $path = 'https://sahabatmukhyar.com/storage/video/' . $filename;

        $ip = IP::get()->random()->name;

        $api_url   = 'http://' . $ip . ':8000/send-message';

        $client = new Client();
        try {
            $response = $client->request("POST", $api_url, [
                'form_params' => [
                    'number' => $nomor,
                    'video' => [
                        "url" => $path,
                    ],
                    "caption" => $isi,
                ]
            ]);

            $riwayat->update([
                'status' => 'success',
                'pengirim' => $ip,
            ]);
        } catch (\Exception $e) {
            $riwayat->update([
                'status' => 'failed',
                'pengirim' => $ip,
                'ket' => $e->getMessage(),
            ]);
        }
    }
}
