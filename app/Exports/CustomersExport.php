<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Id',
            'Company Name',
            'PIC Name',
            'Company Address',
            'Email',
            'No. Handphone',
            'Product Company',
            'Customer Category',
            'Company Field'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return User::all();
        return collect(Customer::exportCustomers());
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:I1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $event->sheet->getActiveSheet()->getStyle($cellRange)
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDefaultStyle()->getFont()->setName('Arial');
            },
        ];
    }
}
