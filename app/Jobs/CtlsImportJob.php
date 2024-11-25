<?php

namespace App\Jobs;

use App\Imports\CtlsImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class CtlsImportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $uploadFile;
    private $ctls_detail;
    /**
     * Create a new job instance.
     */
    public function __construct($uploadFile, $ctls_detail)
    {
        $this->uploadFile = $uploadFile;
        $this->ctls_detail = $ctls_detail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Excel::import(new CtlsImport($this->ctls_detail), $this->uploadFile);
    }
}
