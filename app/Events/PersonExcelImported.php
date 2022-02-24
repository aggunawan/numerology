<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PersonExcelImported
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user_id;
    private $filename;

    public function __construct(int $user_id, string $filename)
    {
        $this->user_id = $user_id;
        $this->filename = $filename;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getFileName(): string
    {
        return $this->filename;
    }
}
