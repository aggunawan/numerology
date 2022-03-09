<?php

namespace App\Listeners;

use App\Events\PalaceDescriptionExcelImported;
use App\Imports\PalaceDescriptionImport;
use Maatwebsite\Excel\Facades\Excel;

class ProcessPalaceDescriptionExcel
{
    public function handle(PalaceDescriptionExcelImported $event)
    {
        Excel::import(new PalaceDescriptionImport(), $event->getFile());
    }
}
