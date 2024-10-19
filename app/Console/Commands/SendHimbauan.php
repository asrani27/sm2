<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use App\Models\Riwayat;
use Illuminate\Console\Command;

class SendHimbauan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendhimbauan';

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
        $riwayat = Riwayat::where('whatsapp_id', 5)->where('status', null)->first();
        $nomor = $riwayat->telp;
        $filename = $riwayat->whatsapp->file;
        $isi = $riwayat->whatsapp->isi;
        $path = 'https://sahabatmukhyar.com/storage/video/' . $filename;

        $api_url   = 'http://103.178.83.190:8000/send-message';

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
                'pengirim' => '103.178.83.190',
            ]);
        } catch (\Exception $e) {
            $riwayat->update([
                'status' => 'failed',
                'pengirim' => '103.178.83.190',
                'ket' => $e->getMessage(),
            ]);
        }
    }
}
