<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\AuditLogEvent;
use App\Listeners\AuditLogListener;

class EventServiceProvider extends ServiceProvider
{
  protected $listen = [
    AuditLogEvent::class => [
      AuditLogListener::class,
    ],
  ];

  public function boot()
  {
    parent::boot();
  }
}
