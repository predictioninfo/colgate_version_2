<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomizeSalarySheetExport implements FromView, ShouldAutoSize, WithStyles
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function styles(Worksheet $sheet)
    {

    }
    public function view(): View
    {
        return view('back-end.premium.emails.customize-salary-sheet-excel', [
            'data' => $this->data,
        ]);
    }
}