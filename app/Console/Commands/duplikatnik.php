<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class duplikatnik extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duplikatnik';

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
        $duplicateNiks = DB::table('dpt_pilkada')
            ->select('nik', DB::raw('COUNT(*) as count'))
            ->groupBy('nik')
            ->having('count', '>', 1)
            ->orderBy('id')
            ->chunk(100, function ($duplicateNiks) {
                foreach ($duplicateNiks as $duplicateNik) {
                    $this->info("Proses NIK: {$duplicateNik->nik}");

                    $ids = DB::table('dpt_pilkada')
                        ->where('nik', $duplicateNik->nik)
                        ->pluck('id')
                        ->toArray();

                    // Batasi update ke ID selain yang pertama
                    $keepFirstId = array_shift($ids);

                    DB::table('dpt_pilkada')
                        ->whereIn('id', $ids)
                        ->update(['nik' => null]);
                }
            });
    }
}
