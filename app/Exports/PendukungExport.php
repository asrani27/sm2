<?php

namespace App\Exports;

use App\Models\Pilkada;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendukungExport implements FromCollection, WithHeadings, WithMapping
{

    protected $kelurahan;
    protected $tps;
    private $number = 0;

    // Konstruktor untuk menerima parameter pencarian
    public function __construct($kelurahan, $tps = null)
    {
        $this->kelurahan = $kelurahan;
        $this->tps = $tps;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $query = Pilkada::select('nama', 'nik', 'tps')
            ->where('kelurahan', strtoupper($this->kelurahan))
            ->orderBy('tps');

        if (!empty($this->tps)) {
            $query->where('tps', $this->tps);
        }

        $results = $query->get();
        return $results;
        // return Pilkada::where('pengumpul_id', '!=', null)->select('nama', 'nik', 'tps')->get();
    }
    public function headings(): array
    {
        return [
            'no',
            'nama',
            'nik',
            'tps'
        ];
    }

    /**
     * Map the data for each row.
     *
     * @param mixed $user
     * @return array
     */
    public function map($user): array
    {
        return [
            ++$this->number, // Increment nomor urut
            $user->nama,
            $user->nik,
            $user->tps,
        ];
    }
}
