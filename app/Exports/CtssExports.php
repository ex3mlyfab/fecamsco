<?php

namespace App\Exports;



use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CtssExports implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    // private $export_info;
    // // public function __construct($saving_upload_detail)
    // // {
    // //     $this->export_info =$saving_upload_detail;
    // // }


    public function query()
    {
        // return Loan::query()->with('user'); Member::whereIn('status', [3,6])
        return Member::query()
            ->whereIn('Status', [3,6])
            ->with('user'); 
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

    public function map($member): array
    {
        return [
            'FEDERAL STAFF HOSPITAL JABI',
            $member->user->fullname,
            $member->user->current_deduction,
            $member->ippis_no,
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
