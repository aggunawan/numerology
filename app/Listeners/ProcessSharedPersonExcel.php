<?php

namespace App\Listeners;

use App\Events\SharedPersonExcelImported;
use App\Imports\SharedPersonImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;

class ProcessSharedPersonExcel implements ShouldQueue
{
    public function handle(SharedPersonExcelImported $event)
    {
        Excel::import(new SharedPersonImport(), $event->getFileName());
    }
}
