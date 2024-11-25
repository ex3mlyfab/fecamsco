<?php

namespace App\Exports;

use App\Models\Installment;
use App\Models\Loan;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CtlsExports implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    // private $export_info;
    // // public function __construct($saving_upload_detail)
    // // {
    // //     $this->export_info =$saving_upload_detail;
    // // }


    public function query()
    {
        // return Loan::query()->with('user');
        return Loan::query()->whereHas('installments', function ($query) {
            $query->where('status', 0);
        });
    }

    public function headings(): array
    {
        return [
            'Ministry Name',
            'Employee Name',
            'Deduction Amount',
            'IPPIS NO',
            'Details'
        ];
    }

    public function map($loans): array
    {
        return [
            'FEDERAL STAFF HOSPITAL JABI',
            $loans->user->fullname,
            $loans->next_installment->amount,
            $loans->user->member->ippis_no,
           'CTSS_FESHA JABI'
        ];
    }

    public function fields(): array
    {
        return [
            'ministry_name',
            'employee_name',
            'deduction_amount',
            'ippis_no',
            'details'
        ];
    }
}
