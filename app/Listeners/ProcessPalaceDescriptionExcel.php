<?php

namespace App\Listeners;

use App\Events\PalaceDescriptionExcelImported;
use App\Imports\PalaceDescriptionImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;

class ProcessPalaceDescriptionExcel implements ShouldQueue
{
    public function handle(PalaceDescriptionExcelImported $event)
    {
        Excel::import(new PalaceDescriptionImport(), $event->getFile());
    }
}
