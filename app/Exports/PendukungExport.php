<?php

namespace App\Exports;

use App\Models\Pilkada;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendukungExport implements FromCollection, WithHeadings, WithMapping
{

    private $number = 0;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pilkada::where('pengumpul_id', '!=', null)->select('nama', 'nik', 'tps')->get();
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
