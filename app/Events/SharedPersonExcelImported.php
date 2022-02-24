<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SharedPersonExcelImported
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function getFileName(): string
    {
        return $this->filename;
    }
}
