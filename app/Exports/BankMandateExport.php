<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class BankMandateExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    private $export_info;
    public function __construct($saving_upload_detail)
    {
        $this->export_info =$saving_upload_detail;
    }

    
    public function query()
    {
        return Transaction::query()->with('user');
    }

    public function headings(): array
    {
        return [
            '#',
            'Description',
            'Amount',
            'User',
            'Created At'
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->description,
            $transaction->amount,
            $transaction->user->name,
            $transaction->created_at
        ];
    }

    public function fields(): array
    {
        return [
            'id',
            'description',
            'amount',
            'user',
            'created_at'
        ];
    }
}
