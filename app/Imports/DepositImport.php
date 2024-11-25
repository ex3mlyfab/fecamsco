<?php

namespace App\Imports;

use App\Models\SavingUpload;
use App\Models\SavingUploadDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepositImport implements ToModel,WithHeadingRow, WithChunkReading
{
    private $saving_upload_info;

    public function __construct($saving_upload_detail)
    {
        $this->saving_upload_info =$saving_upload_detail;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SavingUpload([
            'saving_upload_detail_id' => $this->saving_upload_info,
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
