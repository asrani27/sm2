<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CompareUsia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commpareusia';

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
        $total = DB::table('your_table_name')->whereNotNull('tanggal_lahir')->count();
        $this->info("Total records to process: $total");

        $counter = 0;

        DB::table('dpt')
            ->whereNotNull('tanggal_lahir')
            ->chunk(100, function ($records) use ($total, &$counter) {
                foreach ($records as $record) {
                    list($tanggal, $bulan, $tahun) = explode('|', $record->tanggal_lahir);
                    $tanggal_lahir_carbon = Carbon::createFromDate($tahun, $bulan, $tanggal);
                    $usia = $tanggal_lahir_carbon->age;

                    // Update usia di database
                    DB::table('your_table_name')
                        ->where('id', $record->id)
                        ->update(['usia' => $usia]);

                    $counter++;

                    // Tampilkan progress setiap 100 record atau saat proses selesai
                    if ($counter % 100 === 0 || $counter === $total) {
                        $this->info("Processed $counter of $total records.");
                    }
                }
            });

        $this->info('Update completed!');
    }
}
