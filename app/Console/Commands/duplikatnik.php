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
            ->get();

        if ($duplicateNiks->isEmpty()) {
            $this->info('Tidak ada NIK yang duplikat.');
        } else {
            $this->info('Daftar NIK yang duplikat:');
            foreach ($duplicateNiks as $duplicateNik) {
                $this->line("NIK: {$duplicateNik->nik} - Jumlah: {$duplicateNik->count}");
            }
        }
    }
}
