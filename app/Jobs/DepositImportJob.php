<?php

namespace App\Jobs;

use App\Imports\DepositImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class DepositImportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $uploadFile;
    public $saving_upload_detail;
    /**
     * Create a new job instance.
     */
    public function __construct($uploadFile, $saving_upload_detail)
    {
        $this->uploadFile = $uploadFile;
        $this->saving_upload_detail = $saving_upload_detail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new DepositImport($this->saving_upload_detail), $this->uploadFile);
    }
}
