<?php

namespace App\Console\Commands;

use App\Models\Suara;
use Illuminate\Console\Command;

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
        $data = Suara::query()->update([
            'nomor_1' => 0,
            'nomor_2' => 0,
            'nomor_3' => 0,
            'sah' => 0,
            'tidak_sah' => 0,
        ]);
        if ($data) {
            return response()->json(['message' => 'Data berhasil diperbarui.'], 200);
        } else {
            return response()->json(['message' => 'Tidak ada data yang diperbarui.'], 400);
        }
    }
}
