<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Models\Riwayat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DispathcWA implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $wa;
    protected $data;
    public function __construct($wa, $data)
    {
        $this->wa = $wa;
        $this->data = $data;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path       = config('app.url') . '/storage/video/' . $this->data->file;
        $message    = $this->data->isi;
        $api_url    = 'http://103.178.83.200:8000/send-message';
        $client     = new Client();

        try {
            $response = $client->request("POST", $api_url, [
                'form_params' => [
                    'number' => $this->wa->nomor,
                    'video' => [
                        "url" => $path,
                    ],
                    "caption" => $message,
                ]
            ]);

            sleep(5);
            $r = new Riwayat;
            $r->whatsapp_id = $this->data->id;
            $r->telp = $this->wa->nomor;
            $r->status = 'success';
            $r->save();
        } catch (\Exception $e) {
            $r = new Riwayat;
            $r->whatsapp_id = $this->data->id;
            $r->telp = $this->wa->nomor;
            $r->status = 'failed';
            $r->save();
        }
    }
}
