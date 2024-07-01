<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuditLogEvent
{
    use Dispatchable, SerializesModels;

    public $userId;
    public $action;
    public $description;

    public function __construct($userId, $action, $description = null)
    {
        $this->userId = $userId;
        $this->action = $action;
        $this->description = $description;
    }
}
