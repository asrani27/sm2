<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CompareNIK extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comparenik';

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
        $dpt_pilkada = DB::table('dpt_pilkada')->whereNull('nik')->get();

        $total = $dpt_pilkada->count();
        $this->info("Total records to process: $total");
        foreach ($dpt_pilkada as $key => $item) {
            $data = DB::table('dpt')
                ->where('nama', $item->nama)
                ->where('kelurahan', $item->kelurahan)
                ->where('rt', $item->rt)
                ->get();
            if (count($data) === 1) {
                DB::table('dpt_pilkada')
                    ->where('id', $item->id)
                    ->update(['nik' => $data->first()->nik]);

                $this->info("Updated nik untuk {$item->nama}");
            }

            // Menampilkan progres setiap 100 item
            if (($key + 1) % 100 === 0 || $key + 1 === $total) {
                $this->info("Processed $key of $total records.");
            }
        }
        $this->info('Update completed!');
    }
}
