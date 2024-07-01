<?php

namespace App\Listeners;

use App\Events\AuditLogEvent;
use App\Models\AuditLogs;

class AuditLogListener
{
    public function handle(AuditLogEvent $event)
    {
        AuditLogs::create([
            'user_id' => $event->userId,
            'action' => $event->action,
            'description' => $event->description,
        ]);
    }
}
