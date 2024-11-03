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

        DB::beginTransaction();

        try {
            // Step 1: Ambil NIK yang duplikat beserta salah satu ID yang akan dipertahankan

            $duplicateNiks = DB::table('dpt_pilkada')
                ->select('nik')
                ->groupBy('nik')
                ->havingRaw('COUNT(nik) > 1')
                ->pluck('nik'); // Ambil hanya nilai NIK

            if ($duplicateNiks->isEmpty()) {
                $this->info('Tidak ada NIK yang duplikat.');
                DB::rollBack();
                return;
            }

            // Step 2: Update semua NIK yang terduplikasi menjadi NULL
            DB::table('dpt_pilkada')
                ->whereIn('nik', $duplicateNiks)
                ->update(['nik' => null]);

            DB::commit();
            $this->info("Semua NIK duplikat telah di-NULL-kan.");
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan jika ada kesalahan
            $this->error("Terjadi kesalahan: " . $e->getMessage());
        }
    }
}
