<?php

namespace App\Exports;

use App\Models\Pipeline;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PipelinesExportAll implements FromCollection, WithHeadings, ShouldAutoSize
{

    public function headings(): array
    {
        return [
            'Id',
            'Customer Id',
            'Perusahaan',
            'Kategori Customer',
            'nama PIC',
            'No. Handphone',
            'Email',
            'Item',
            'Produk Perusahaan',
            'Status',
            'Date_Of_Contact',
            'Contact By',
            'Contact Via',
            'Remarks',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect(Pipeline::exportAllPipelines());
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:L1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $event->sheet->getActiveSheet()->getStyle($cellRange)
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDefaultStyle()->getFont()->setName('Arial');
            },
        ];
    }
}