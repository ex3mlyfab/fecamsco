<?php

namespace App\Imports;

use App\Models\Ctls;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CtlsImport implements ToModel,WithHeadingRow, WithChunkReading
{
    private $credit_detail;

    public function __construct($ctls_detail)
    {
        $this->credit_detail = $ctls_detail;
    }

     /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Ctls([
            'ctls_detail_id' => $this->credit_detail,
            'employee_name' => $row['employee_name'],
            'deduction_amount' => $row['deduction_amount'],
            'employee_number' => $row['employee_number'],
            'saving_linked' => 0

        ]);
    }
    public function chunkSize(): int
    {
        return 5000;
    }
}
