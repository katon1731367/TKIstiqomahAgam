<?php

namespace App\Exports;

use App\Models\TeamSales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class TeamSalesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Id',
            'Team Name',
            'Team Leader',
            'Total Sales Staff',
            'Total Sales Stage',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect(TeamSales::exportTeamSales());
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:E1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $event->sheet->getActiveSheet()->getStyle($cellRange)
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDefaultStyle()->getFont()->setName('Arial');
            },
        ];
    }
}
