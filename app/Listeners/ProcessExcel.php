<?php

namespace App\Listeners;

use App\Events\PersonExcelImported;
use App\Imports\PersonImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;

class ProcessExcel implements ShouldQueue
{
    public function handle(PersonExcelImported $event)
    {
        Excel::import(new PersonImport($event->getUserId()), $event->getFileName());
    }
}
